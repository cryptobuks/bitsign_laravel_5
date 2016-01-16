<?php

namespace App\Providers;

use App\Packages\UserEncrypter;
use RuntimeException;
use Illuminate\Support\ServiceProvider;

class UserEncrypterServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('userencrypter', function ($app) {
            $config = $app->make('config')->get('app');

            $key = $config['key'];

            $cipher = $config['cipher'];

            if (UserEncrypter::supported($key, $cipher)) {
                return new UserEncrypter($key, $cipher);
            } else {
                throw new RuntimeException('No supported encrypter found. The cipher and / or key length are invalid.');
            }
        });
    }
}
