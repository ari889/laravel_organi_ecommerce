<?php

use App\Http\Livewire\Backend\Dashboard\DashboardComponent;
use App\Http\Livewire\Backend\Settings\SettingComponent;
use App\Http\Livewire\Frontend\Blog\BlogComponent;
use App\Http\Livewire\Frontend\Cart\CartComponent;
use App\Http\Livewire\Frontend\Contact\ContactComponent;
use App\Http\Livewire\Frontend\Favorite\FavoriteComponent;
use App\Http\Livewire\Frontend\Home\HomeComponent;
use App\Http\Livewire\Frontend\Shop\ShopComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class)->name('home'); // for home
Route::get('/shop', ShopComponent::class)->name('shop'); // for shop
Route::get('/blog', BlogComponent::class)->name('blog'); // for blog
Route::get('/contact', ContactComponent::class)->name('contact'); // for contact
Route::get('/cart', CartComponent::class)->name('cart'); // for cart
Route::get('/favorite', FavoriteComponent::class)->name('favorite'); // for cart

/**
 * admin route group
 */
Route::group(['middleware' => ['auth', 'verified', 'authadmin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
    Route::get('/setting', SettingComponent::class)->name('setting');
});

