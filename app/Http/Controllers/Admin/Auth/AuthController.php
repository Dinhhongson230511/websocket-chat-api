<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminChangePasswordRequest;
use App\Http\Requests\Admin\Auth\AdminForgotPasswordRequest;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;
use App\Models\PasswordReset;
use App\Providers\RouteServiceProvider;
use App\Services\Admin\AdminAuthServices;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected AdminAuthServices $adminAuthServices;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminAuthServices $adminAuthServices)
    {
        $this->middleware('guest')->except('logout');
        $this->adminAuthServices = $adminAuthServices;
    }

    /**
     * Show the application login form admin.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        return view('admin.pages.auth.login');
    }

    /**
     * login app admin
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials) && (Auth::user()->isAdmin() ||
            Auth::user()->isCompany() ||
            Auth::user()->isStore() ||
            Auth::user()->isAgency()
        )) {
            return redirect(RouteServiceProvider::ADMIN)->with([
                'status' => ResponseStatus::SUCCESS->value,
                'message' => __('auth.message.login.success')
            ]);
        }

        Auth::logout();
        return redirect()->route('admin.login.form')->with([
            'status' => ResponseStatus::ERROR->value,
            'message' => __('auth.message.login.error')
        ]);
    }

    /**
     * logout app
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin.login.form')->with([
            'status' => ResponseStatus::SUCCESS->value,
            'message' => __('auth.message.logout.success')
        ]);
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm(): View
    {
        return view('admin.pages.auth.passwords.email');
    }

    /**
     * send email reset link
     *
     * @param  AdminForgotPasswordRequest $request
     * @return RedirectResponse
     */
    public function sendResetPassword(AdminForgotPasswordRequest $request): RedirectResponse
    {
        $response = $this->adminAuthServices->sendEmailResetLink($request->validated());
        return redirect()->route('admin.password.forgot')->with([
            'status' => $response['status'],
            'message' => $response['message']
        ]);
    }

    /**
     *  Display the form to change password.
     *
     * @return View|RedirectResponse
     */
    public function showChangePasswordForm(): View|RedirectResponse
    {
        if (PasswordReset::checkTokenForgotPassword(request()->query('token'))) {
            return view('admin.pages.auth.passwords.reset');
        }
        return redirect()->route('admin.password.forgot')->with([
            'status' => ResponseStatus::ERROR->value,
            'message' => __('auth.reset_password.message.token_fail')
        ]);
    }

    /**
     * Change password for admin
     *
     * @param  AdminChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function changePassword(AdminChangePasswordRequest $request): RedirectResponse
    {
        $response = $this->adminAuthServices->changePassword($request->validated());
        $routeName = $response['status'] === ResponseStatus::SUCCESS->value ? 'admin.login.form' : 'admin.password.reset';
        return redirect()->route($routeName)->with([
            'status' => $response['status'],
            'message' => $response['message']
        ]);
    }
}
