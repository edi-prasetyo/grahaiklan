<?php

use App\Http\Controllers\Admin\AdvertisementController as AdminAdvertisementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantContoller;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\AdvertisementController;
use App\Http\Controllers\Frontend\FrontendController;
// use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'verify' => true,
    'reset'    => true,  // for resetting passwords 
    'confirm'  => true,  // for additional password confirmations
    'verify'   => true,  // for email verification 

]);


// Frontend
Route::get('/', [FrontendController::class, 'index']);
// Route::get('/category', [FrontendController::class, 'categories']);
Route::post('/fetch-city', [FrontendController::class, 'fetchCity']);
Route::post('/fetch-subcategory', [FrontendController::class, 'fetchSubcategory']);
Route::get('/category/{category_slug}', [FrontendController::class, 'products']);

Route::get('verify/otp', [FrontendController::class, 'verify_otp'])->name('verify_otp');
Route::post('/send-otp', [FrontendController::class, 'send_otp'])->name('send_otp');
Route::post('/resend-otp', [FrontendController::class, 'resend_otp'])->name('resend_otp');
Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page');

// Advertisement
Route::get('/iklan', [AdvertisementController::class, 'index']);
Route::get('/category', [AdvertisementController::class, 'category']);
Route::get('/category/{category_slug}', [AdvertisementController::class, 'category_detail']);
Route::get('/category/{category_slug}/{slug}', [AdvertisementController::class, 'subcategory']);
Route::get('/detail/{ads_slug}', [AdvertisementController::class, 'show']);
Route::post('/store', [AdvertisementController::class, 'store']);
Route::get('/result', [AdvertisementController::class, 'search']);
Route::get('/user/{uuid}', [AdvertisementController::class, 'user']);


// Custom Reset Password
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// New Member
Route::middleware(['auth', 'isMember'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    Route::get('/my-ads', [HomeController::class, 'myads'])->name('myads');
    Route::get('/my-ads/edit/{advertisement_id}', [HomeController::class, 'edit_myads'])->name('edit_myads');

    Route::post('/update-profile', [HomeController::class, 'update_profile']);
    Route::get('/create', [HomeController::class, 'create'])->name('create');
    Route::post('/member-store', [HomeController::class, 'store'])->name('store');
    // Add Iklan
    Route::get('/add-iklan', [HomeController::class, 'add_iklan']);
    Route::get('/add-iklan/{slug}', [HomeController::class, 'add_iklan_sub']);
    Route::get('/add-iklan/{category_slug}/{slug}', [HomeController::class, 'create_iklan']);
    Route::get('/edit-iklan/{category_slug}/{slug}/{advertisement_id}', [HomeController::class, 'edit_iklan']);
    Route::post('/store-iklan', [HomeController::class, 'store_iklan']);

    Route::post('/fetch-city-member', [HomeController::class, 'fetchCity']);

    Route::get('/update-password', [HomeController::class, 'edit_password']);
    Route::put('/update_password', [HomeController::class, 'update_password']);
    Route::get('/seller', [HomeController::class, 'seller']);
    Route::put('/add-seller', [HomeController::class, 'add_seller']);

    Route::get('category', [HomeController::class, 'category']);
    Route::get('packages', [HomeController::class, 'packages']);
    Route::post('order', [HomeController::class, 'order_package']);
    Route::get('payment/{uuid}', [HomeController::class, 'payment']);
    Route::put('receipt/{uuid}', [HomeController::class, 'receipt']);
    Route::get('delete-account', [HomeController::class, 'destroy_account']);
});


// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/delete/{category}', 'destroy');
        Route::post('category/fetch-brand', 'fetchBrand');
        // Subcategory Route
        Route::get('/category/subcategory/{category}', 'subcategory');
        Route::post('/category/subcategory/', 'store_subcategory');
        Route::get('/category/edit-subcategory/{subcategory}', 'edit_subcategory');
        Route::put('/category/update-subcategory/{subcategory_id}', 'update_subcategory');
        Route::get('/category/delete-subcategory/{subcategory}', 'destroy_subcategory');
        // Field Route
        Route::get('/category/subcategory/field/{subcategory}', 'field');
        Route::post('/category/subcategory/field/', 'store_field');
    });

    // Variant Route
    Route::controller(VariantContoller::class)->group(function () {
        Route::get('/variants', 'index');
        Route::get('/variants/create', 'create');
        Route::post('/variants', 'store');
        Route::get('/variants/edit/{variant}', 'edit');
        Route::put('/variants/{variant}', 'update');
        Route::get('/variants/delete/{variant}', 'destroy');
    });
    // Advertisement Route
    Route::controller(AdminAdvertisementController::class)->group(function () {
        Route::get('/advertisements', 'index');
        Route::get('/advertisements/show/{id}', 'show');
        Route::get('/advertisements/publish/{id}', 'publish');
    });

    // Page Route
    Route::controller(PageController::class)->group(function () {
        Route::get('/pages', 'index');
        Route::get('/pages/create', 'create');
        Route::post('/pages', 'store');
        Route::get('/pages/edit/{page}', 'edit');
        Route::put('/pages/{page}', 'update');
        Route::get('/pages/delete/{page_id}', 'destroy');
    });
    // Bank Route
    Route::controller(BankController::class)->group(function () {
        Route::get('/banks', 'index');
        Route::get('/banks/create', 'create');
        Route::post('/banks', 'store');
        Route::get('/banks/edit/{bank}', 'edit');
        Route::put('/banks/{bank}', 'update');
    });
    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{order_id}', 'show');
        Route::post('/orders/confirmation/{order_id}', 'confirmation');
    });
    // Sliders Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/edit/{slider}', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/delete/{slider}', 'destroy');
    });


    // Option Route
    Route::controller(OptionController::class)->group(function () {
        Route::get('/options', 'index');
        Route::get('/options/edit/{brand}', 'edit');
        Route::post('/options', 'update');
    });
    // Province Route
    Route::controller(ProvinceController::class)->group(function () {
        Route::get('/provinces', 'index');
        Route::post('/provinces', 'store');
        Route::get('/provinces/create', 'create');
        Route::get('/provinces/edit/{brand}', 'edit');
        Route::put('/provinces', 'update');
        Route::get('/provinces/delete/{province}', 'destroy');
        // City Route
        Route::get('/provinces/city/{province}', 'city');
        Route::post('/provinces/city/', 'store_city');
        Route::get('/provinces/city/delete/{city}', 'destroy_city');
    });

    // Icon Route
    Route::controller(IconController::class)->group(function () {
        Route::get('/icons', 'index');
        Route::post('/icons', 'store');
    });
    // Users Route
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
    });
    // Package Route
    Route::controller(PackageController::class)->group(function () {
        Route::get('/packages', 'index');
        Route::post('/packages', 'store');
        Route::get('/packages/create', 'create');
        Route::get('/packages/show/{id}', 'show');
        Route::get('/packages/edit/{id}', 'edit');
        Route::post('/packages/update/{id}', 'update');
        Route::get('/packages/delete/{id}', 'destroy');
    });
});
