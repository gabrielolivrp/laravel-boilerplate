<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $rdi = new RecursiveDirectoryIterator(app_path('Helpers'));
        $it = new RecursiveIteratorIterator($rdi);

        while ($it->valid()) {
            if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php'
                && strpos($it->current()->getFilename(), 'Helper')) {
                require $it->key();
            }

            $it->next();
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
