@component('mail::message')
    @lang('mail.body.reset_password.success', [
        'name' => $data['name'],
        'email' => $data['email'],
        'url' => $data['url']
    ])
    @lang('mail.footer', [
        'email' => config('const.email_support')
    ])
@endcomponent
