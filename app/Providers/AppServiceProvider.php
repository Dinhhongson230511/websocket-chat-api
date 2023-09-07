<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->maxCharactersValidate();
    }

    protected function maxCharactersValidate()
    {
        Validator::extend('max_characters', function ($attribute, $value, $maxLength) {
            if (!empty($value) && countCharacters($value) > $maxLength[0]) {
                return false;
            }
            return true;
        });
        Validator::replacer('max_characters', function ($message, $attribute, $rule, $maxLength) {
            return str_replace(':max', $maxLength[0], $message);
        });
    }
}
