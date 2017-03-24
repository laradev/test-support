<?php

namespace Laradev\Test\Support\Fixtures;

use Illuminate\Support\ServiceProvider;

final class SucceedingServiceProvider extends ServiceProvider
{
    const SERVICE_ID = 'succeeding';
    
    public function boot()
    {
        $config = self::getConfigFile();
        
        $this->publishes([
            $config => config_path(self::SERVICE_ID.'.php'),
        ], self::SERVICE_ID);
        
        $this->mergeConfigFrom($config, self::SERVICE_ID);
    }
    
    public static function getConfigFile():string
    {
        return __DIR__.'/config.php';
    }
}