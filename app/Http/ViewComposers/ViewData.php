<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Status;
class ViewData {
//    protected $param;

  /**
   * Create a new  composer.
   * @return void
   */
  public function __construct() {
    // Dependencies automatically resolved by service container...
  }

  /**
   * Bind data to the view.
   *
   * @param  View  $view
   * @return void
   */
  public function compose(View $view) {
    $listStatus = Status::orderBy('position','asc')->get();
    $view->with('listStatus', $listStatus);
  }
}