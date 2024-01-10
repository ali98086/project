<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Content\FAQController as ContentFAQController;
use App\Http\Controllers\Admin\Content\MenuController as ContentMenuController;
use App\Http\Controllers\Admin\Content\PageMakerController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\User\AdminController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function () {

        Route::prefix('category')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('admin.market.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/show/{id}', [CategoryController::class, 'show'])->name('admin.market.category.show');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.market.category.destroy');

        });

        Route::prefix('brand')->group(function () {

            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand.index');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/show/{id}', [BrandController::class, 'show'])->name('admin.market.brand.show');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{id}', [BrandController::class, 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{id}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');
        });

        Route::prefix('comment')->group(function () {

            Route::get('/', [CommentController::class, 'index'])->name('admin.market.comment.index');
            Route::get('/show', [CommentController::class, 'show'])->name('admin.market.comment.show');
            Route::post('/store', [CommentController::class, 'store'])->name('admin.market.comment.store');
            Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.market.comment.destroy');
        });

        Route::prefix('delivery')->group(function () {

            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery.index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{id}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');
        });

        Route::prefix('discount')->group(function () {

            Route::get('/copan', [DiscountController::class, 'copan'])->name('admin.market.discount.copan');
            Route::get('/copan/create', [DiscountController::class, 'copanCreate'])->name('admin.market.discount.copan.create');
            Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
            Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');
        });

        Route::prefix('order')->group(function () {

            Route::get('/new-orders', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/sending-orders', [OrderController::class, 'sendingOrders'])->name('admin.market.order.sendingOrders');
            Route::get('/unpaid-orders', [OrderController::class, 'unpaidOrders'])->name('admin.market.order.unpaidOrders');
            Route::get('/invalid-orders', [OrderController::class, 'invalidOrders'])->name('admin.market.order.invalidOrders');
            Route::get('/returned-orders', [OrderController::class, 'returnedOrders'])->name('admin.market.order.returnedOrders');
            Route::get('/all-orders', [OrderController::class, 'allOrders'])->name('admin.market.order.allOrders');
            Route::get('/see-factor', [OrderController::class, 'seeFactor'])->name('admin.market.order.seeFactor');
            Route::get('/change-state-send', [OrderController::class, 'changeStateSend'])->name('admin.market.order.changeStateSend');
            Route::get('/change-state-order', [OrderController::class, 'changeStateOrder'])->name('admin.market.order.changeStateOrder');
            Route::get('/invalid-order', [OrderController::class, 'invalidOrder'])->name('admin.market.order.invalidOrder');
        });

        Route::prefix('payment')->group(function () {

            Route::get('/all', [PaymentController::class, 'index'])->name('admin.market.payment.index');
            Route::get('/online-payments', [PaymentController::class, 'onlinePayments'])->name('admin.market.payment.onlinePayments');
            Route::get('/offline-payments', [PaymentController::class, 'offlinePayments'])->name('admin.market.payment.offlinePayments');
            Route::get('/attendance', [PaymentController::class, 'attendance'])->name('admin.market.payment.attendance');
            Route::get('/confirm', [PaymentController::class, 'confirm'])->name('admin.market.payment.confirm');
        });


        Route::prefix('product')->group(function () {

            Route::get('/index', [ProductController::class, 'index'])->name('admin.market.product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.market.product.show');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');


            //gallery
            Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.market.gallery.index');
            Route::post('/gallery/store', [GalleryController::class, 'store'])->name('admin.market.gallery.store');
            Route::delete('/gallery/destroy/{id}', [GalleryController::class . 'destroy'])->name('admin.market.gallery.destroy');
        });

        Route::prefix('property')->group(function () {

            Route::get('/index', [PropertyController::class, 'index'])->name('admin.market.property.index');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/show/{id}', [PropertyController::class, 'show'])->name('admin.market.property.show');
            Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{id}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{id}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');
        });

        Route::prefix('store')->group(function () {

            Route::get('/', [StoreController::class, 'index'])->name('admin.market.store.index');
            Route::get('/create', [StoreController::class, 'create'])->name('admin.market.store.create');
            Route::post('/store', [StoreController::class, 'store'])->name('admin.market.store.store');
            Route::get('/show/{id}', [StoreController::class, 'show'])->name('admin.market.store.show');
            Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('admin.market.store.edit');
            Route::put('/update/{id}', [StoreController::class, 'update'])->name('admin.market.store.update');
            Route::delete('/destroy/{id}', [StoreController::class, 'destroy'])->name('admin.market.store.destroy');
        });
    });

    Route::prefix('content')->namespace('Content')->group(function () {

        Route::prefix('category')->group(function () {

            Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category.index');
            Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');
            Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');
            Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');
            Route::delete('/destroy/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
            Route::get('/status/{postCategory}', [ContentCategoryController::class , 'status'])->name('admin.content.category.status');
        });

        Route::prefix('comment')->group(function () {

            Route::get('/', [ContentCommentController::class, 'index'])->name('admin.content.comment.index');
            Route::get('/show/{id}', [ContentCommentController::class, 'show'])->name('admin.content.comment.show');
            Route::post('/store', [ContentCommentController::class, 'store'])->name('admin.content.comment.store');
            Route::get('/edit/{id}', [ContentCommentController::class, 'edit'])->name('admin.content.comment.edit');
            Route::put('/update/{id}', [ContentCommentController::class, 'update'])->name('admin.content.comment.update');
            Route::delete('/destroy/{id}', [ContentCommentController::class, 'destroy'])->name('admin.content.comment.destroy');
        });

        Route::prefix('faq')->group(function () {

            Route::get('/', [ContentFAQController::class, 'index'])->name('admin.content.faq.index');
            Route::get('/create', [ContentFAQController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [ContentFAQController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{id}', [ContentFAQController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{id}', [ContentFAQController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{id}', [ContentFAQController::class, 'destroy'])->name('admin.content.faq.destroy');
        });

        Route::prefix('menu')->group(function () {

            Route::get('/', [ContentMenuController::class, 'index'])->name('admin.content.menu.index');
            Route::get('/create', [ContentMenuController::class, 'create'])->name('admin.content.menu.create');
            Route::post('/store', [ContentMenuController::class, 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{id}', [ContentMenuController::class, 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{id}', [ContentMenuController::class, 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{id}', [ContentMenuController::class, 'destroy'])->name('admin.content.menu.destroy');
        });

        Route::prefix('page-maker')->group(function () {

            Route::get('/', [PageMakerController::class, 'index'])->name('admin.content.page-maker.index');
            Route::get('/create', [PageMakerController::class, 'create'])->name('admin.content.page-maker.create');
            Route::post('/store', [PageMakerController::class, 'store'])->name('admin.content.page-maker.store');
            Route::get('/edit/{id}', [PageMakerController::class, 'edit'])->name('admin.content.page-maker.edit');
            Route::put('/update/{id}', [PageMakerController::class, 'update'])->name('admin.content.page-maker.update');
            Route::delete('/destroy/{id}', [PageMakerController::class, 'destroy'])->name('admin.content.page-maker.destroy');
        });

        Route::prefix('post')->group(function () {

            Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{id}', [PostController::class, 'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
        });
    });

    Route::prefix('user')->namespace('User')->group(function () {

        Route::prefix('admin')->group(function () {

            Route::get('/', [AdminController::class, 'index'])->name('admin.user.admin.index');
            Route::get('/create', [AdminController::class, 'create'])->name('admin.user.admin.create');
            Route::post('/store', [AdminController::class, 'store'])->name('admin.user.admin.store');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.admin.edit');
            Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.user.admin.update');
            Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.user.admin.destroy');
        });

        Route::prefix('customer')->group(function () {

            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{id}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
        });

        Route::prefix('role')->group(function () {

            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
        });
    });


        Route::prefix('notify')->namespace('Notify')->group(function(){

            Route::prefix('email')->group(function(){

                Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email.index');
                Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
                Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
                Route::get('/edit/{id}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
                Route::put('/update/{id}', [EmailController::class, 'update'])->name('admin.notify.email.update');
                Route::delete('/destroy/{id}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
            });

            Route::prefix('sms')->group(function(){

                Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
                Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
                Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
                Route::get('/edit/{id}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
                Route::put('/update/{id}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
                Route::delete('/destroy/{id}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            });

        });

        Route::prefix('ticket')->namespace('Ticket')->group(function(){

            Route::get('/new-ticket', [TicketController::class , 'newTickets'])->name('admin.ticket.new-tickets');
            Route::get('/open-ticket', [TicketController::class , 'openTickets'])->name('admin.ticket.open-tickets');
            Route::get('/close-ticket', [TicketController::class , 'closeTickets'])->name('admin.ticket.close-tickets');
            Route::get('/show-ticket', [TicketController::class , 'showTickets'])->name('admin.ticket.show-tickets');
            
        });

        Route::prefix('setting')->namespace('Setting')->group(function(){

            Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
            Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create');
            Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store');
            Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
            Route::put('/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');
            Route::delete('/destroy/{id}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');
            
        });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
