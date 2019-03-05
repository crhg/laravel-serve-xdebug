<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2019-03-05
 * Time: 22:25
 */

namespace Crhg\LaravelServeXdebug\Providers;


use Crhg\LaravelServeXdebug\Console\Commands\ServeCommand;
use Illuminate\Support\ServiceProvider;

class ServeXdebugProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([ServeCommand::class]);
        }
    }
}