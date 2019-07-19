<?php

namespace GNAHotelSolutions\Flasher;

use Illuminate\Support\ServiceProvider;

class FlasherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Flasher::class);
    }
}
