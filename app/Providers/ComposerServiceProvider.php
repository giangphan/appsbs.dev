<?php
namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

  /**
   * Register bindings in the container.
   *
   * @return void
   */
  public function boot() {
    // Using class based composers...
    View::composer('*', 'App\Http\ViewComposers\ViewData');

    // Using Closure based composers...
//        View::composer('frontend.layout', function()
//        {
//          $menu = 'A|B|C';
//          $view->with('menus', $menus);
//        });
  }

  /**
   * Register
   *
   * @return void
   */
  public function register() {
    //
  }
}