<?php

namespace Laradev\Test\Support\Fixtures;

use Illuminate\Support\ServiceProvider;

final class SucceedingServiceProvider extends ServiceProvider
{
    const SERVICE_ID = 'succeeding';
    
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $config = self::getConfigFile();
        
        $this->publishes([
            $config => config_path(self::SERVICE_ID.'.php'),
        ], self::SERVICE_ID);
        
        $this->mergeConfigFrom($config, self::SERVICE_ID);
    }
    
    /**
     * Get the path of the package configuration path
     * 
     * @return string
     */
    public static function getConfigFile():string
    {
        return __DIR__.'/config.php';
    }
}