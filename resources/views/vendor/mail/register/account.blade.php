@component('mail::message')
    @lang('mail.body.register_account.success', [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
        'url' => $data['url']
    ])
    @lang('mail.footer', [
        'email' => config('const.email_support')
    ])
@endcomponent
