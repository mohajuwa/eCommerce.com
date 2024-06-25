<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ProductFront;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

// User Middleware
Route::group(['middleware' => 'user'], function () {
    // DashBoard routes
    Route::get('user/dashboard', [UserController::class, 'dashboard']);
    Route::get('user/orders', [UserController::class, 'orders']);
    Route::get('user/edit-profile', [UserController::class, 'editProfile']);
    Route::post('user/edit-profile', [UserController::class, 'updateProfile']);

    Route::get('user/change-password', [UserController::class, 'changePassword']);
    Route::post('user/change-password', [UserController::class, 'updatePassword']);

    Route::get('user/detail/{id}', [UserController::class, 'orderDetail']);

    // WishList

    Route::get('my-wishlist', [UserController::class, 'myWishlist']);

    Route::post('add_to_wishlist', [UserController::class, 'addToWishList']);

    // Review

    Route::post('user/make-review', [UserController::class, 'submitReview']);

    Route::post('blog/submit_comment', [HomeController::class, 'submitBlogComment']);
});

// Admin Middleware
Route::group(['middleware' => 'isAdmin'], function () {

    // Notification routes
    Route::get('admin/notification', [PageController::class, 'notification']);

    // DashBoard routes
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    // Route::get('cart', [PaymentController::class, 'cartShow']);

    // Admin Users routes
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/customer/list', [CustomerController::class, 'customerList']);
    Route::get('admin/customer/add', [CustomerController::class, 'customerAdd']);
    Route::post('admin/customer/add', [CustomerController::class, 'customerInsert']);
    Route::get('admin/customer/edit/{id}', [CustomerController::class, 'customerEdit']);
    Route::post('admin/customer/edit/{id}', [CustomerController::class, 'customerUpdate']);
    Route::get('admin/customer/delete/{id}', [CustomerController::class, 'customerDelete']);

    // Order Users routes
    Route::get('admin/order/list', [OrderController::class, 'list']);
    Route::get('admin/order/detail/{id}', [OrderController::class, 'orderDetail']);
    Route::get('admin/order_status', [OrderController::class, 'orderStatus']);

    // Categories routes
    Route::get('admin/category/list', [CategoryController::class, 'list']);
    Route::get('admin/category/add', [CategoryController::class, 'add']);
    Route::post('admin/category/add', [CategoryController::class, 'insert']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);

    // Sub Category routes
    Route::get('admin/sub_category/list', [SubCategoryController::class, 'list']);
    Route::get('admin/sub_category/add', [SubCategoryController::class, 'add']);
    Route::post('admin/sub_category/add', [SubCategoryController::class, 'insert']);
    Route::get('admin/sub_category/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::post('admin/sub_category/edit/{id}', [SubCategoryController::class, 'update']);
    Route::get('admin/sub_category/delete/{id}', [SubCategoryController::class, 'delete']);

    Route::post('admin/get_sub_category', [SubCategoryController::class, 'getSubCategory']);

    // Products routes
    Route::get('admin/product/list', [ProductController::class, 'list']);
    Route::get('admin/product/add', [ProductController::class, 'add']);
    Route::post('admin/product/add', [ProductController::class, 'insert']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/edit/{id}', [ProductController::class, 'update']);
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('admin/product/image_delete/{id}', [ProductController::class, 'imageDelete']);
    Route::post('admin/product_image_sortable', [ProductController::class, 'productImageSortable']);

    // Brands routes
    Route::get('admin/brand/list', [BrandController::class, 'list']);
    Route::get('admin/brand/add', [BrandController::class, 'add']);
    Route::post('admin/brand/add', [BrandController::class, 'insert']);
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('admin/brand/edit/{id}', [BrandController::class, 'update']);
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);

    // Colors routes
    Route::get('admin/color/list', [ColorController::class, 'list']);
    Route::get('admin/color/add', [ColorController::class, 'add']);
    Route::post('admin/color/add', [ColorController::class, 'insert']);
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit']);
    Route::post('admin/color/edit/{id}', [ColorController::class, 'update']);
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);

    // Discount routes
    Route::get('admin/discount_code/list', [DiscountCodeController::class, 'list']);
    Route::get('admin/discount_code/add', [DiscountCodeController::class, 'add']);
    Route::post('admin/discount_code/add', [DiscountCodeController::class, 'insert']);
    Route::get('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'edit']);
    Route::post('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'update']);
    Route::get('admin/discount_code/delete/{id}', [DiscountCodeController::class, 'delete']);

    // Shipping Charge routes
    Route::get('admin/shipping_charge/list', [ShippingChargeController::class, 'list']);
    Route::get('admin/shipping_charge/add', [ShippingChargeController::class, 'add']);
    Route::post('admin/shipping_charge/add', [ShippingChargeController::class, 'insert']);
    Route::get('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'edit']);
    Route::post('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'update']);
    Route::get('admin/shipping_charge/delete/{id}', [ShippingChargeController::class, 'delete']);

    // Slider routes
    Route::get('admin/slider/list', [SliderController::class, 'list']);
    Route::get('admin/slider/add', [SliderController::class, 'add']);
    Route::post('admin/slider/add', [SliderController::class, 'insert']);
    Route::get('admin/slider/edit/{id}', [SliderController::class, 'edit']);
    Route::post('admin/slider/edit/{id}', [SliderController::class, 'update']);
    Route::get('admin/slider/delete/{id}', [SliderController::class, 'delete']);

    // Partner routes
    Route::get('admin/partner/list', [PartnerController::class, 'list']);
    Route::get('admin/partner/add', [PartnerController::class, 'add']);
    Route::post('admin/partner/add', [PartnerController::class, 'insert']);
    Route::get('admin/partner/edit/{id}', [PartnerController::class, 'edit']);
    Route::post('admin/partner/edit/{id}', [PartnerController::class, 'update']);
    Route::get('admin/partner/delete/{id}', [PartnerController::class, 'delete']);

    // Contact Us routes
    Route::get('admin/contact_us', [PageController::class, 'contactUs']);
    Route::get('admin/contact_us/delete/{id}', [PageController::class, 'contactUsDelete']);

    // Page routes
    Route::get('admin/page/list', [PageController::class, 'list']);
    Route::get('admin/page/edit/{id}', [PageController::class, 'edit']);
    Route::post('admin/page/edit/{id}', [PageController::class, 'update']);

    // Blog Categoy routes
    Route::get('admin/blog_category/list', [BlogCategoryController::class, 'list']);
    Route::get('admin/blog_category/add', [BlogCategoryController::class, 'add']);
    Route::post('admin/blog_category/add', [BlogCategoryController::class, 'insert']);
    Route::get('admin/blog_category/edit/{id}', [BlogCategoryController::class, 'edit']);
    Route::post('admin/blog_category/edit/{id}', [BlogCategoryController::class, 'update']);
    Route::get('admin/blog_category/delete/{id}', [BlogCategoryController::class, 'delete']);

    // Blog  routes
    Route::get('admin/blog/list', [BlogController::class, 'list']);
    Route::get('admin/blog/add', [BlogController::class, 'add']);
    Route::post('admin/blog/add', [BlogController::class, 'insert']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit']);
    Route::post('admin/blog/edit/{id}', [BlogController::class, 'update']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'delete']);

    // Settings routes
    Route::get('admin/system-setting', [PageController::class, 'systemSettings']);
    Route::post('admin/system-setting', [PageController::class, 'updateSystemSettings']);

    // Home Settings routes
    Route::get('admin/home-setting', [PageController::class, 'homeSettings']);
    Route::post('admin/home-setting', [PageController::class, 'updateHomeSettings']);
});

Route::get('/', [HomeController::class, 'home']);
Route::post('recent_arrival_category_product', [HomeController::class, 'RecentArrivalCategoryProduct']);
Route::get('blog', [HomeController::class, 'blog']);
Route::get('blog/{slug}', [HomeController::class, 'blogDetail']);
Route::get('blog/category/{slug}', [HomeController::class, 'blogCategory']);

Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact', [HomeController::class, 'submitContact']);
Route::get('about', [HomeController::class, 'about']);

Route::get('faq', [HomeController::class, 'faq']);
Route::get('payment-methods', [HomeController::class, 'payment_methods']);
Route::get('money-back-guarantee', [HomeController::class, 'money_back_guarantee']);
Route::get('return', [HomeController::class, 'return']);
Route::get('shipping', [HomeController::class, 'shipping']);
Route::get('terms-conditions', [HomeController::class, 'terms_conditions']);
Route::get('privacy-policy', [HomeController::class, 'privacy_policy']);

Route::get('cart', [PaymentController::class, 'cart']);
Route::get('cart/delete/{id}', [PaymentController::class, 'cartDelete']);
Route::post('update_cart', [PaymentController::class, 'updateCart']);
Route::get('checkout', [PaymentController::class, 'checkout']);
Route::post('checkout/applyDiscountCode', [PaymentController::class, 'applyDiscountCode']);
Route::post('checkout/placeOrder', [PaymentController::class, 'placeOrder']);
Route::get('checkout/payment', [PaymentController::class, 'checkoutPayment']);
Route::get('paypal/success-payment', [PaymentController::class, 'paypalSuccessPayment']);
Route::get('stripe/payment-success', [PaymentController::class, 'stripeSuccessPayment']);

Route::post('auth_register', [AuthController::class, 'auth_register']);
Route::post('auth_login', [AuthController::class, 'auth_login']);

Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::post('forgot-password', [AuthController::class, 'auth_forgot_password']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'auth_reset']);

Route::get('activate/{id}', [AuthController::class, 'activate_email']);

Route::get('search', [ProductFront::class, 'getProductSearch']);
Route::get('{category?}/{subcategory?}', [ProductFront::class, 'getCategory']);
Route::post('get_prodcut_filter_ajax', [ProductFront::class, 'getProdcutFIlterAjax']);

Route::post('product/add-to-cart', [PaymentController::class, 'insertToCart']);
