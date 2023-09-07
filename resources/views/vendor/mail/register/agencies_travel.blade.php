@component('mail::message')
    @lang('mail.body.register_agencies_travel.success', [
        'name' => $data['name'],
        'url' => $data['url'],
        'emailAddress' => $data['emailAddress'],
        'password' => $data['password']
    ])
    @lang('mail.footer', [
        'email' => config('const.email_support')
    ])
@endcomponent
