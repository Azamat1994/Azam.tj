<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use Inertia\Inertia;
use App\Models\Crude;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PermissionController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laratrust\LaratrustFacade;
use Laratrust\Laratrust;


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


Route::middleware('auth')->group(function () {
    Route::post(
        '/orders/completed/{order}',
        [OrderController::class, 'completed']
    )->name('orders.completed');

    Route::get('logout', function () {
        Auth::logout();
        return redirect(route('auth.login'));
    });
    Route::get('/dashboard', function () {
        return Inertia::render('Index');
    });
    Route::post('/upload-files', [CrudeController::class, 'uploadFiles'])->name('upload-files');


    Route::get('/dashboard/grant', function () {
        return Inertia::render('Permissions/Grant', [
            'permissions' => Permission::all(),
            'users' => User::all(),
        ]);
    });

    Route::post('/users/grant/{user}', [UserController::class, 'grant'])->name('users.grant');
    Route::post('/users/permissions/{user}', [UserController::class, 'permissions'])->name('users.permissions');

    Route::get('/dashboard/orders/archive', [OrderController::class, 'archive'])->name('orders.archive');


    $components = array(
        ["Category", "categories"],
        ["City", "cities"],
        ["Crude", "crudes"],
        ["Comment", "comments"],
//        ["Delivery", "deliveries"],
        ["Order", "orders"],
        ["Partner", "partners"],
        ["Permission", "permissions"],
        ["Post", "posts"],
        ["Product", "products"],
        ["Role", "roles"],
        ["Slider", "sliders"],
        ["Status", "statuses"],
        ["Unit", "units"],
        ["User", "users"],
        ["Warehouse", "warehouses"],
        ["Shop", "shops"]);

    $permission_actions = array(
        ["create", ['create', 'store']],
        ["read", ['index', 'show']],
        ["update", ['edit', 'update']],
        ["delete", ['destroy']]);

    foreach ($components as $component) {
        foreach ($permission_actions as $permission_action) {

            Route::resource('/dashboard/' . $component[1], 'App\Http\Controllers\\' . $component[0] . 'Controller', [
                'names' => $component,
                'only' => $permission_action[1],
                'middleware' => ['permission:' . $component[1] . '-' . $permission_action[0]]
            ]);

        }
    }

//    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
//        Route::resources([
//            '/dashboard/roles' => RoleController::class,
//        ]);
//
//    });

//    Route::resources([
//        '/dashboard/users' => UserController::class,
//        '/dashboard/units' => UnitController::class,
//        '/dashboard/categories' => CategoryController::class,
//        '/dashboard/cities' => CityController::class,
//        '/dashboard/crudes' => CrudeController::class,
//        '/dashboard/statuses' => StatusController::class,
//        '/dashboard/products' => ProductController::class,
//        '/dashboard/orders' => OrderController::class,
//        '/dashboard/partners' => PartnerController::class,
//        '/dashboard/permissions' => PermissionController::class,
//        '/dashboard/sliders' => SliderController::class,
//        '/dashboard/posts' => PostController::class,
//    ]);

    Route::get('dashboard/get-bids', [BidController::class, 'index'])->name('get-bids');
    // Route::resource('/roles', \App\Http\Controllers\RoleController::class)->name('*', 'roles');

    // Auth
    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
        Route::post('/set-avatar', [ProfileController::class, 'setAvatar'])->name('profile.avatar');
        Route::post('/confirm-order', [ProfileController::class, 'confirmOrder'])->name('confirm-order');
        Route::get('/history', [ProfileController::class, 'history'])->name('history');
        Route::get('/bonus', [ProfileController::class, 'bonus'])->name('bonus');
        Route::get('/checkout', [ProfileController::class, 'checkout'])->name('checkout');
    });
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/repairs', [HomeController::class, 'repairs'])->name('repairs');
Route::post('/repairs', [HomeController::class, 'repairsBid'])->name('repairs-save');
Route::post('/partner-bid', [HomeController::class, 'partnerBid'])->name('partner-bid-save');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/mass-media', [HomeController::class, 'massMedia'])->name('mass-media');
Route::get('/filter/{id}', [HomeController::class, 'filterByCategoryId'])->name('filterByCategoryId');
Route::get('/filter', [HomeController::class, 'filter'])->name('filter');
Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('/product/{slug}', [HomeController::class, 'showProduct'])->name('show-product');
Route::get('/news/{slug}', [HomeController::class, 'news'])->name('news');
Route::post('/add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('addToCart');
Route::post('/remove-cart', [HomeController::class, 'removeCart'])->name('removeCart');
Route::post('/set-quantity/{type}', [HomeController::class, 'setQuantity'])->name('setQuantity');
Route::post('/send-complaint', [HomeController::class, 'sendComplaint'])->name('sendComplaint');
Route::post('/getProductsQuantity', [ProductController::class, 'getProductsQuantity'])->name('getProductsQuantity');
Route::get('/size-table', [HomeController::class, 'sizeTable'])->name('sizeTable');
Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::get('/thank-you', [HomeController::class, 'thankYou'])->name('thank-you');
Route::get('/delivery', [HomeController::class, 'delivery'])->name('delivery');
Route::get('/return', [HomeController::class, 'return'])->name('return');
Route::post('/store', [CommentController::class, 'store'])->name('comment.store');

// Auth
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/sign-in', [AuthController::class, 'signIn'])->name('auth.sign-in');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.register.store');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
    Route::post('/confirm-password/{type}', [AuthController::class, 'confirmPassword'])->name('auth.confirm.password');
});

Route::get('/test/{id}', function ($id) {
    User::find($id)->update([
        'password' => 'password'
    ]);
    // $product = Product::find($id);
    // if(!$product) {
    //     abort(404);
    // }
    // $cart = session()->get('cart') ? session()->get('cart') : [];
    // $cart[$id] = [
    //     "name" => $product->name,
    //     "quantity" => 1,
    //     "price" => $product->price,
    // ];
    // session()->put('cart', $cart);
    // return response()->json(session()->get('cart'));
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');
