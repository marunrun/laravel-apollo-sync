<?php
/**
 * Created by mr
 * Date: 2020/1/16
 * Time: 17:58
 */

namespace Run\Apollo\Client;


use Illuminate\Support\ServiceProvider;
use Run\Apollo\Client\Console\SyncConfig;

class ApolloSyncServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        SyncConfig::class,
    ];

    public function boot()
    {
        $configPath = __DIR__ . '/../config/ide-helper.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('apollo.php');
        } else {
            $publishPath = base_path('config/apollo.php');
        }
        if ($this->app->runningInConsole()) {
            $this->publishes([$configPath => $publishPath], 'config');
        }


    }

    public function register()
    {
        $this->commands($this->commands);

    }
}