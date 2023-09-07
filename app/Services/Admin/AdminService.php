<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Services\BaseService;
use App\Enums\Role;
use Illuminate\Support\Facades\DB;
use App\Enums\ResponseStatus;
use Illuminate\Support\Str;

class AdminService extends BaseService
{
    public function getList()
    {
        return User::query()->where([
            ['role_id', '=', Role::ADMIN->value],
            ['id', '!=', auth()->id()],
        ])->paginate(config('const.common_per_page'));
    }

    public function create(array $data): array
    {
        DB::beginTransaction();
        try {
            $password = Str::random(8);
            $data['password'] = $password;
            $user = User::query()->create($data);
            $this->sendEmail(
                $user->email,
                __('mail.subject.create_account'),
                'vendor.mail.register.account',
                [
                    'name' => $user->fullName,
                    'url' => route('admin.login.form'),
                    'email' => $user->email,
                    'password' => $password,
                ]
            );
            DB::commit();
            return [
                'status' => ResponseStatus::SUCCESS->value,
                'message' => __('admin/users.created_user_success')
            ];
        } catch (\Throwable $throwable) {
            DB::rollback();
            return [
                'status' => ResponseStatus::ERROR->value,
                'message' => __('admin/users.created_user_fail')
            ];
        }
    }
}
