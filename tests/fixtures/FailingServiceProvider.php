<?php

namespace Laradev\Test\Support\Fixtures;

use Illuminate\Support\ServiceProvider;

final class FailingServiceProvider extends ServiceProvider
{
    const SERVICE_ID = 'failing';
    
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
    }
}