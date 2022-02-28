<?php

use App\Http\Controllers\Backend\Coupon\AdminCouponController;
use App\Http\Controllers\Backend\Dashboard\AdminDashboardOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontend\Blog\BlogComponent;
use App\Http\Livewire\Frontend\Cart\CartComponent;
use App\Http\Livewire\Frontend\Home\HomeComponent;
use App\Http\Livewire\Frontend\Shop\ShopComponent;
use App\Http\Livewire\Backend\Product\ProductComponent;
use App\Http\Livewire\Backend\Settings\SettingComponent;
use App\Http\Livewire\Frontend\Contact\ContactComponent;
use App\Http\Livewire\Frontend\Favorite\FavoriteComponent;
use App\Http\Livewire\Backend\Dashboard\DashboardComponent;
use App\Http\Livewire\Backend\Category\AdminCategoryController;
use App\Http\Controllers\Backend\Product\AdminProductController;
use App\Http\Livewire\Backend\Category\AdminAddCategoryConponent;
use App\Http\Livewire\Backend\Category\AdminEditCategoryConponent;
use App\Http\Livewire\Backend\Category\AdminEditSubcategoryComponent;
use App\Http\Livewire\Backend\Coupon\AdminAddCouponComponent;
use App\Http\Livewire\Backend\Coupon\AdminCouponComponent;
use App\Http\Livewire\Backend\Coupon\AdminEditCouponComponent;
use App\Http\Livewire\Backend\HomeCategory\HomeCategoryComponent;
use App\Http\Livewire\Backend\Order\AdminEditOrderComponent;
use App\Http\Livewire\Backend\Order\AdminOrderViewComponent;
use App\Http\Livewire\Backend\Product\AdminAddProductComponent;
use App\Http\Livewire\Backend\Product\AdminEditProductComponent;
use App\Http\Livewire\Frontend\Category\CategoryComponent;
use App\Http\Livewire\Frontend\Checkout\ThankyouCheckout;
use App\Http\Livewire\Frontend\Checkout\UserCheckoutComponent;
use App\Http\Livewire\Frontend\Dashboard\UserDashboardCompoennt;
use App\Http\Livewire\Frontend\ForgetPassword\UserForgetPasswordComponent;
use App\Http\Livewire\Frontend\Login\LoginComponent;
use App\Http\Livewire\Frontend\Order\UserOrderComponent;
use App\Http\Livewire\Frontend\ProductDetail\ProductDetailComponent;
use App\Http\Livewire\Frontend\Register\UserRegisterComponent;
use App\Http\Livewire\Frontend\Resetpassword\ResetPasswordComponent;
use App\Http\Livewire\Frontend\Review\UserReviewComponent;
use App\Http\Livewire\Frontend\Search\SearchComponent;

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
Route::get('/category/{slug}', CategoryComponent::class)->name('category'); // for cart
Route::get('/product/{slug}', ProductDetailComponent::class)->name('product.detail'); // for cart
Route::get('/login', LoginComponent::class)->name('login'); // for cart
Route::get('/register', UserRegisterComponent::class)->name('register'); // for cart
Route::get('/forgot-password', UserForgetPasswordComponent::class)->name('password.request'); // for cart
Route::get('/thankyou', ThankyouCheckout::class)->name('thankyou'); // thankyou after checkout
Route::get('/search', SearchComponent::class)->name('search'); // thankyou after checkout

Route::get('/checkout', UserCheckoutComponent::class)->name('checkout')->middleware(['auth', 'verified', 'checkout']);

/**
 * user route group
 */
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/dashboard', UserDashboardCompoennt::class)->name('dashboard');
    Route::get('/user/order/{id}', UserOrderComponent::class)->name('order');
    Route::get('/user/review/{id}', UserReviewComponent::class)->name('review');
});

/**
 * admin route group
 */
Route::group(['middleware' => ['auth', 'verified', 'authadmin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    /**
     * for admin dashboard
     */
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');

    /**
     * for setting
     */
    Route::get('/setting', SettingComponent::class)->name('setting');

    /**
     * for category
     */
    Route::get('/category', AdminCategoryController::class)->name('category');
    Route::get('/category/add', AdminAddCategoryConponent::class)->name('addcategory');
    Route::get('/category/edit/{id}', AdminEditCategoryConponent::class)->name('editcategory');
    Route::get('/subcategory/edit', AdminEditSubcategoryComponent::class)->name('editsubcategory');

    /**
     * for product
     */
    Route::get('/product', ProductComponent::class)->name('product');
    Route::get('/product/add', AdminAddProductComponent::class)->name('addproduct');
    Route::post('/getproducts', [AdminProductController::class, 'getallproducts'])->name('getallproducts');
    Route::get('/product/edit/{id}', AdminEditProductComponent::class)->name('product.edit');
    Route::post('/product/delete', [AdminProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/bulk/delete', [AdminProductController::class, 'bulkDelete'])->name('product.bulk.delete');

    /**
     * for coupons
     */
    Route::get('/coupons', AdminCouponComponent::class)->name('coupons');
    Route::get('/coupon/add', AdminAddCouponComponent::class)->name('addcoupon');
    Route::get('/coupon/edit/{id}', AdminEditCouponComponent::class)->name('editcoupon');
    Route::post('/getallcoupon', [AdminCouponController::class, 'getAllCoupon'])->name('getallcoupon');
    Route::post('/coupon/delete', [AdminCouponController::class, 'destroy'])->name('coupon.delete');
    Route::post('/coupon/bulk/delete', [AdminCouponController::class, 'bulkDelete'])->name('coupon.bulk.delete');

    /**
     * for dashboard
     */
    Route::post('/orders', [AdminDashboardOrderController::class, 'getAllOrders'])->name('getallorders');
    Route::post('/order/delete', [AdminDashboardOrderController::class, 'destroy'])->name('order.delete');
    Route::post('/order/bulk/delete', [AdminDashboardOrderController::class, 'bulkDelete'])->name('order.bulk.delete');

    /**
     * for order
     */
    Route::get('/order/{id}', AdminOrderViewComponent::class)->name('order.view');
    Route::get('/order/edit/{id}', AdminEditOrderComponent::class)->name('order.edit');

    /**
     * manage home
     */
    Route::get('/homecategory', HomeCategoryComponent::class)->name('home.category');
});

