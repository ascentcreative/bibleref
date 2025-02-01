<?php

namespace AscentCreative\BibleRef;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;

class BibleRefServiceProvider extends ServiceProvider
{
  public function register()
  {
    //

    // Register the helpers php file which includes convenience functions:
    require_once (__DIR__.'/helpers.php');
   
    $this->mergeConfigFrom(
        __DIR__.'/../config/bibleref.php', 'bibleref'
    );

  }

  public function boot()
  {

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'bibleref');

    $this->loadRoutesFrom(__DIR__.'/../routes/bibleref-web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    $this->bootPublishes();

    $this->bootComponents();

    packageAssets()->addStylesheet('/vendor/ascent/bibleref/dist/css/ascent-bibleref-bundle.css');
    packageAssets()->addScript('/vendor/ascent/bibleref/dist/js/ascent-bibleref-bundle.js');
    
  }

  

    // register the components
    public function bootComponents() {

        Blade::component('bibleref-fields-biblereftokens', 'AscentCreative\BibleRef\Components\Fields\BibleRefTokens');

    }




  

    public function bootPublishes() {

      $this->publishes([
        __DIR__.'/../assets' => public_path('vendor/ascent/bibleref'),
    
      ], 'public');

      $this->publishes([
        __DIR__.'/../config/bibleref.php' => config_path('bibleref.php'),
      ]);

    }



}