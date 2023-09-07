<?php

namespace App\Services\Admin;

use App\Enums\ResponseStatus;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminAuthServices extends BaseService
{
    /**
     * send email Reset Link
     *
     * @param  mixed $request
     * @return array
     */
    public function sendEmailResetLink(array $request): array
    {
        try {
            $user = User::where('email', $request['email'])->first();
            if ($user) {
                $token = bcrypt($request['email']);
                PasswordReset::updateOrCreate(
                    ['email' => $request['email']],
                    [
                        'email' => $request['email'],
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]
                );

                $this->sendEmail(
                    $request['email'],
                    __('mail.subject.reset_password'),
                    'vendor.mail.auth.reset_password',
                    [
                        'name' => $user->full_name,
                        'email' => $user->email,
                        'url' => route('admin.password.reset', ['token' => $token])
                    ]
                );
            }

            return [
                'status' => ResponseStatus::SUCCESS->value,
                'message' => __('auth.reset_password.message.send_mail_success')
            ];
        } catch (\Exception $e) {
            Log::error('Send email reset password error: ' . $e);
            return [
                'status' => ResponseStatus::ERROR->value,
                'message' => __('auth.reset_password.message.send_mail_error')
            ];
        }
    }

    /**
     * changePassword
     *
     * @param  array $request
     * @return array
     */
    public function changePassword(array $request): array
    {
        try {
            DB::beginTransaction();
            $userPasswordReset = PasswordReset::where('token', $request['token'])->first();
            $user = User::where('email', $userPasswordReset->email)->first();
            if (!$user) {
                throw new Exception();
            }
            $user->update([
                'password' => $request['new_password']
            ]);
            $userPasswordReset->delete();

            DB::commit();
            return [
                'status' => ResponseStatus::SUCCESS->value,
                'message' => __('auth.reset_password.message.success')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning('Change password error: ' . $e);
            return [
                'status' => ResponseStatus::ERROR->value,
                'message' => __('auth.reset_password.message.error')
            ];
        }
    }

    /**
     * checkTokenForgotPassword
     *
     * @param  mixed $token
     * @return bool
     */
    public function checkTokenForgotPassword(string $token): bool
    {
        $user = PasswordReset::where('token', $token)->first();
        return $user && $user->isTokenNotExpires();
    }
}
