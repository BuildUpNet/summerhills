<?php

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgeVerificationController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('subcategories', SubcategoryController::class);
});


Route::get('/clear-all', function () {
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    return "All caches cleared!";
});

Route::get('/routes', function () {
    $routes = collect(\Illuminate\Support\Facades\Route::getRoutes())->map(function ($route) {
        return [
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => $route->getActionName(),
            'methods' => $route->methods(),
        ];
    });
    return response()->json($routes);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'accountUser'])->name('account');
    Route::put('/account/update', [AccountController::class, 'updateAccount'])->name('account.update');
    Route::put('/account/update-password', [AccountController::class, 'updatePassword'])->name('account.update.password');
});

Route::get('/age-blocked', [AgeVerificationController::class, 'blocked'])->name('age.blocked');
Route::post('/age-verify', [AgeVerificationController::class, 'verify'])->name('age.verify');

Route::get('/', function () {
    $products = Product::latest()->take(6)->get();

    $wishlistIds = [];
    if (Auth::check()) {
        $wishlistIds = Auth::user()->wishlist()->pluck('product_id')->toArray();
    }

$BestProduct = Product::where('best_product', 1)->get();
 $BannerProduct = Product::where('banner_product', 1)->take(4)->get();
    $settings = WebsiteSetting::first();
     $categories = ProductCategory::all();
    return view('index', compact('products', 'settings' , 'categories' , 'BestProduct' , 'wishlistIds' , 'BannerProduct'));
})->name('home');

Route::get('/about', function () {
    $settings = WebsiteSetting::first();
    $categories = ProductCategory::all();

  $totalUsers = User::count();
    $totalProducts = Product::count();

    return view('about', compact('settings', 'categories', 'totalUsers', 'totalProducts'));
})->name('about');

Route::get('/admin/category/{id}/subcategories', [ProductController::class, 'getSubcategories'])
     ->name('admin.categories.subcategories');



Route::get('/category/{id}', [ProductController::class, 'showByCategory'])->name('category.products');

Route::get('/contact', [ContactController::class, 'contactpage'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');



Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
         $totalProducts = Product::count();
        $totalCategories = ProductCategory::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalWishlistProducts = Wishlist::count();

        return view('Admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'totalWishlistProducts'
        ));
    })->name('Admin.Dashboard');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
Route::post('/products/toggle-banner', [ProductController::class, 'toggleBannerProduct'])->name('admin.toggleBannerProduct');

Route::get('/products', [ProductController::class, 'show'])->name('products.show');

Route::post('/admin/best-product', [ProductController::class, 'toggleBestProduct'])
     ->name('admin.toggleBestProduct');
     Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/product/{slug}', [ProductController::class, 'SinglePage'])->name('products.single');
Route::post('/reviews/store', [ProductController::class, 'storeReview'])->name('reviews.store');


Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/delete/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.delete');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [WebsiteSettingController::class, 'edit'])->name('admin.settings');
    Route::post('/settings', [WebsiteSettingController::class, 'update'])->name('admin.settings.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('categories', ProductCategoryController::class)->except(['show']);
});
Route::get('/customers', [AccountController::class, 'index'])->name('customers.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'settings'])->name('admin.profile');
    Route::post('/admin/settings/profile', [AdminController::class, 'updateProfile'])->name('admin.settings.profile');
    Route::post('/admin/settings/password', [AdminController::class, 'updatePassword'])->name('admin.settings.password');
});