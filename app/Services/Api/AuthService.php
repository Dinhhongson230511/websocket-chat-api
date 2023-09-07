<?php

namespace App\Services\Api;

use App\Enums\AccountStatus;
use App\Enums\ResponseStatus;
use App\Enums\Role;
use App\Enums\TravelAgencyStatus;
use App\Http\Resources\User\UserResource;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthService
 */
class AuthService extends BaseService
{

    public function login($request)
    {
        $user = User::with('travelAgency')
                ->getUserByEmail($request->email)
                ->first();
        $travelAgencyStatus = $user?->travelAgency->approval_status->isApproved();
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => Role::AGENCY->value,
        ];
        if (!Auth::attempt($credentials) || !$travelAgencyStatus) {
            Log::info('##########USER LOGIN FAIL: ', $credentials);

            return [
                'status' => false
            ];
        }
        Log::info('##########USER IS LOGIN WITH IP : ' . $request->get('ip') . '_AT_' . now()->format('Y/m/d H:m:s'));

        return [
            'user' => new UserResource($user),
            'access_token' => $user->createToken('authToken')->plainTextToken,
            'status' => true
        ];
    }

    /**
     * send email update password for user
     *
     * @param  string $email
     * @return bool
     */
    public function sendEmailUpdatePassword(string $email): bool
    {
        $user = User::getUserByEmail($email)->first();
        if (!$user) {
            return false;
        }
        $token = bcrypt($email);
        PasswordReset::create([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $this->sendEmail(
            $email,
            __('mail.subject.reset_password'),
            'vendor.mail.auth.reset_password',
            [
                'name' => $user->full_name,
                'email' => $user->email,
                'url' => config('const.url_reset_password_user') . '?token=' . $token
            ]
        );
        return true;
    }

    /**
     * check token
     *
     * @param  string $token
     * @return bool
     */
    public function checkToken(string $token): bool
    {
        if ($token && PasswordReset::checkTokenForgotPassword($token)) {
            return true;
        }
        return false;
    }

    /**
     * change update password for user
     *
     * @param  array $request
     * @return array
     */
    public function resetUpdatePassword(array $request): array
    {
        $resultDefault = [
            'status' => false,
            'data' => []
        ];
        try {
            DB::beginTransaction();
            $passwordResetByToken = PasswordReset::getPasswordResetByToken($request['token'])->first();
            $user = User::getUserByEmail($passwordResetByToken->email)->first();
            if ($user && PasswordReset::checkTokenForgotPassword($request['token'])) {
                $user->update(['password' => $request['new_password']]);
                $passwordResetByToken->delete();
                DB::commit();
                $resultDefault = [
                    'status' => true,
                    'data' => new UserResource($user)
                ];
            }
            return $resultDefault;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning('Change password error: ' . $e);
            return $resultDefault;
        }
    }

    /**
     * changePassword
     *
     * @param  array $params
     * @return array
     */
    public function changePassword(array $params): array
    {
        $user = auth()->user();
        $user->update([
            'password' => $params['new_password']
        ]);
        return [
            'status' => true,
            'data' => new UserResource($user)
        ];
    }
}
