<?php
/**
 * Created by mr
 * Date: 2020/1/16
 * Time: 17:58
 */

namespace Run\Apollo\Client;


use Illuminate\Support\ServiceProvider;

class ApolloSyncServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $configPath = __DIR__ . '/../config/ide-helper.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('apollo.php');
        } else {
            $publishPath = base_path('config/apollo.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }

    public function register()
    {
        $configPath = __DIR__ . '/../config/apollo.php';
        $this->mergeConfigFrom($configPath, 'apollo');

        $this->commands(
            'command.apollo:sync-config'
        );
    }
}