<?php

namespace Hsuan\LaravelHasherNTLM\Providers;

use Hsuan\LaravelHasherNTLM\Hashing\NTLMHasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class NTLMHashServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Hash::extend('ntlm', function () {
            return new NTLMHasher();
        });
    }
}