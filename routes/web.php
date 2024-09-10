<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\BannerController;
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
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\CommentController as ProductCommentController;
use App\Http\Controllers\Admin\Market\ProductGalleryController;
use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\Market\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\Market\Profile\AddressController as ProfileAddressController;
use App\Http\Controllers\Customer\Market\Profile\CustomerTicketController;
use App\Http\Controllers\Customer\Market\Profile\FavoriteController;
use App\Http\Controllers\Customer\Market\Profile\ProfileController;
use App\Http\Controllers\Customer\Market\Profile\ProfileOrderController;
use App\Http\Controllers\Customer\Market\Profile\UserProfileController;
use App\Http\Controllers\Customer\Market\SalesProcess\AddressController;
use App\Http\Controllers\Customer\Market\SalesProcess\CartController;
use App\Http\Controllers\Customer\Market\SalesProcess\PaymentController as CustomerPaymentController;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
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


Route::prefix('admin')->namespace('Admin')->middleware('AdminAuth')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function () {

        Route::prefix('category')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('admin.market.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/show/{productcategory}', [CategoryController::class, 'show'])->name('admin.market.category.show');
            Route::get('/edit/{productcategory}', [CategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{productcategory}', [CategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{productcategory}', [CategoryController::class, 'destroy'])->name('admin.market.category.destroy');
        });

        Route::prefix('brand')->group(function () {

            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand.index');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/show/{brand}', [BrandController::class, 'show'])->name('admin.market.brand.show');
            Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{brand}', [BrandController::class, 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');
            Route::get('/status/{brand}', [BrandController::class, 'status'])->name('admin.market.brand.status');
        });

        Route::prefix('delivery')->group(function () {

            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery.index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{delivery}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{delivery}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery}', [DeliveryController::class, 'status'])->name('admin.market.delivery.status');
        });

        Route::prefix('discount')->group(function () {


            Route::get('/copan', [DiscountController::class, 'copan'])->name('admin.market.discount.copanDiscount');
            Route::get('/copan/create', [DiscountController::class, 'copanCreate'])->name('admin.market.discount.copanDiscount.create');
            Route::post('/copan/store', [DiscountController::class, 'copanDiscountStore'])->name('admin.market.discount.copanDiscount.store');
            Route::get('/copan/edit/{copan}', [DiscountController::class, 'copanDiscountEdit'])->name('admin.market.discount.copanDiscount.edit');
            Route::put('/copan/update/{copan}', [DiscountController::class, 'copanDiscountUpdate'])->name('admin.market.discount.copanDiscount.update');
            Route::delete('/copan/destroy/{copan}', [DiscountController::class, 'copanDiscountDestroy'])->name('admin.market.discount.copanDiscount.destroy');


            Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
            Route::post('/common-discount/store', [DiscountController::class, 'commonDiscountStore'])->name('admin.market.discount.commonDiscount.store');
            Route::get('/common-discount/edit/{commonDiscount}', [DiscountController::class, 'commonDiscountEdit'])->name('admin.market.discount.commonDiscount.edit');
            Route::put('/common-discount/update/{commonDiscount}', [DiscountController::class, 'commonDiscountUpdate'])->name('admin.market.discount.commonDiscount.update');
            Route::delete('/common-discount/destroy/{commonDiscount}', [DiscountController::class, 'commonDiscountDestroy'])->name('admin.market.discount.commonDiscount.destroy');


            Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');
            Route::post('/amazing-sale/store', [DiscountController::class, 'amazingSaleStore'])->name('admin.market.discount.amazingSale.store');
            Route::get('/amazing-sale/edit/{amazingSale}', [DiscountController::class, 'amazingSaleEdit'])->name('admin.market.discount.amazingSale.edit');
            Route::put('/amazing-sale/update/{amazingSale}', [DiscountController::class, 'amazingSaleUpdate'])->name('admin.market.discount.amazingSale.update');
            Route::delete('/amazing-sale/destroy/{amazingSale}', [DiscountController::class, 'amazingSaleDestroy'])->name('admin.market.discount.amazingSale.destroy');
        });

        Route::prefix('order')->group(function () {

            Route::get('/new-orders', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/sending-orders', [OrderController::class, 'sendingOrders'])->name('admin.market.order.sendingOrders');
            Route::get('/unpaid-orders', [OrderController::class, 'unpaidOrders'])->name('admin.market.order.unpaidOrders');
            Route::get('/invalid-orders', [OrderController::class, 'invalidOrders'])->name('admin.market.order.invalidOrders');
            Route::get('/returned-orders', [OrderController::class, 'returnedOrders'])->name('admin.market.order.returnedOrders');
            Route::get('/all-orders', [OrderController::class, 'allOrders'])->name('admin.market.order.allOrders');
            Route::get('/see-factor/{order}', [OrderController::class, 'seeFactor'])->name('admin.market.order.seeFactor');
            Route::get('/see-factor/{order}/details', [OrderController::class, 'details'])->name('admin.market.order.details');
            Route::get('/change-status-send/{order}', [OrderController::class, 'changeStatusSend'])->name('admin.market.order.changeStatusSend');
            Route::get('/change-status-order/{order}', [OrderController::class, 'changeStatusOrder'])->name('admin.market.order.changeStatusOrder');
            Route::get('/invalid-order/{order}', [OrderController::class, 'invalidOrder'])->name('admin.market.order.invalidOrder');
        });

        Route::prefix('payment')->group(function () {

            Route::get('/all', [PaymentController::class, 'index'])->name('admin.market.payment.index');
            Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('admin.market.payment.show');
            Route::get('/online-payments', [PaymentController::class, 'onlinePayments'])->name('admin.market.payment.onlinePayments');
            Route::get('/offline-payments', [PaymentController::class, 'offlinePayments'])->name('admin.market.payment.offlinePayments');
            Route::get('/cash-payments', [PaymentController::class, 'cashPayments'])->name('admin.market.payment.cashPayments');
            Route::get('/canceled/{payment}', [PaymentController::class, 'canceled'])->name('admin.market.payment.canceled');
            Route::get('/returned/{payment}', [PaymentController::class, 'returned'])->name('admin.market.payment.returned');
        });


        Route::prefix('product')->group(function () {

            Route::get('/index', [ProductController::class, 'index'])->name('admin.market.product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/show/{product}', [ProductController::class, 'show'])->name('admin.market.product.show');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');

            //color
            Route::get('/color/{product}', [ProductColorController::class, 'index'])->name('admin.market.product.color.index');
            Route::get('/color/create/{product}', [ProductColorController::class, 'create'])->name('admin.market.product.color.create');
            Route::post('/color/store/{product}', [ProductColorController::class, 'store'])->name('admin.market.product.color.store');
            Route::delete('/color/destroy/{product}/{productColor}', [ProductColorController::class, 'destroy'])->name('admin.market.product.color.destroy');

            //gallery
            Route::get('/gallery/{product}', [ProductGalleryController::class, 'index'])->name('admin.market.product.gallery.index');
            Route::get('/gallery/create/{product}', [ProductGalleryController::class, 'create'])->name('admin.market.product.gallery.create');
            Route::post('/gallery/store/{product}', [ProductGalleryController::class, 'store'])->name('admin.market.product.gallery.store');
            Route::delete('/gallery/destroy/{product}/{productGallery}', [ProductGalleryController::class, 'destroy'])->name('admin.market.product.gallery.destroy');

            //guarantee
            Route::get('/guarantee/{product}', [GuaranteeController::class, 'index'])->name('admin.market.product.guarantee.index');
            Route::get('/guarantee/create/{product}', [GuaranteeController::class, 'create'])->name('admin.market.product.guarantee.create');
            Route::post('/guarantee/store/{product}', [GuaranteeController::class, 'store'])->name('admin.market.product.guarantee.store');
            Route::delete('/guarantee/destroy/{product}/{guarantee}', [GuaranteeController::class, 'destroy'])->name('admin.market.product.guarantee.destroy');


            //comment
            Route::get('/comment', [ProductCommentController::class, 'index'])->name('admin.market.comment.index');
            Route::get('/comment/show/{comment}', [ProductCommentController::class, 'show'])->name('admin.market.comment.show');
            Route::get('/comment/status/{comment}', [ProductCommentController::class, 'status'])->name('admin.market.comment.status');
            Route::get('/comment/approved/{comment}', [ProductCommentController::class, 'approved'])->name('admin.market.comment.approved');
            Route::post('/comment/answer/{comment}', [ProductCommentController::class, 'answer'])->name('admin.market.comment.answer');
        });

        Route::prefix('property')->group(function () {

            Route::get('/index', [PropertyController::class, 'index'])->name('admin.market.property.index');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/edit/{categoryAttribute}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{categoryAttribute}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{categoryAttribute}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');

            //propertyValue

            Route::get('/value/{categoryAttribute}', [PropertyValueController::class, 'index'])->name('admin.market.property.value.index');
            Route::get('/value/create/{categoryAttribute}', [PropertyValueController::class, 'create'])->name('admin.market.property.value.create');
            Route::post('/value/store/{categoryAttribute}', [PropertyValueController::class, 'store'])->name('admin.market.property.value.store');
            Route::get('/value/edit/{categoryAttribute}/{value}', [PropertyValueController::class, 'edit'])->name('admin.market.property.value.edit');
            Route::put('/value/update/{categoryAttribute}/{value}', [PropertyValueController::class, 'update'])->name('admin.market.property.value.update');
            Route::delete('/value/destroy/{categoryAttribute}/{value}', [PropertyValueController::class, 'destroy'])->name('admin.market.property.value.destroy');
        });

        Route::prefix('store')->group(function () {

            Route::get('/', [StoreController::class, 'index'])->name('admin.market.store.index');
            Route::get('/create/{product}', [StoreController::class, 'create'])->name('admin.market.store.create');
            Route::post('/store/{product}', [StoreController::class, 'store'])->name('admin.market.store.store');
            Route::get('/edit/{product}', [StoreController::class, 'edit'])->name('admin.market.store.edit');
            Route::put('/update/{product}', [StoreController::class, 'update'])->name('admin.market.store.update');
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
            Route::get('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');
        });

        Route::prefix('comment')->group(function () {

            Route::get('/', [ContentCommentController::class, 'index'])->name('admin.content.comment.index');
            Route::get('/show/{comment}', [ContentCommentController::class, 'show'])->name('admin.content.comment.show');
            Route::post('/store', [ContentCommentController::class, 'store'])->name('admin.content.comment.store');
            Route::get('/status/{comment}', [ContentCommentController::class, 'status'])->name('admin.content.comment.status');
            Route::get('/approved/{comment}', [ContentCommentController::class, 'approved'])->name('admin.content.comment.approved');
            Route::post('/answer/{comment}',  [ContentCommentController::class, 'answer'])->name('admin.content.comment.answer');
        });

        Route::prefix('banner')->group(function () {

            Route::get('/', [BannerController::class, 'index'])->name('admin.content.banner.index');
            Route::get('/create', [BannerController::class, 'create'])->name('admin.content.banner.create');
            Route::post('/store', [BannerController::class, 'store'])->name('admin.content.banner.store');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('admin.content.banner.edit');
            Route::put('/update/{banner}',  [BannerController::class, 'update'])->name('admin.content.banner.update');
            Route::get('/status/{banner}', [BannerController::class, 'status'])->name('admin.content.banner.status');
            Route::delete('/destroy/{banner}', [BannerController::class, 'destroy'])->name('admin.content.banner.destroy');
        });

        Route::prefix('faq')->group(function () {

            Route::get('/', [ContentFAQController::class, 'index'])->name('admin.content.faq.index');
            Route::get('/create', [ContentFAQController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [ContentFAQController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}', [ContentFAQController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}', [ContentFAQController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}', [ContentFAQController::class, 'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}', [ContentFAQController::class, 'status'])->name('admin.content.faq.status');
        });

        Route::prefix('menu')->group(function () {

            Route::get('/', [ContentMenuController::class, 'index'])->name('admin.content.menu.index');
            Route::get('/create', [ContentMenuController::class, 'create'])->name('admin.content.menu.create');
            Route::post('/store', [ContentMenuController::class, 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}', [ContentMenuController::class, 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}', [ContentMenuController::class, 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}', [ContentMenuController::class, 'destroy'])->name('admin.content.menu.destroy');
            Route::get('/status/{menu}', [ContentMenuController::class, 'status'])->name('admin.content.menu.status');
        });

        Route::prefix('page-maker')->group(function () {

            Route::get('/', [PageMakerController::class, 'index'])->name('admin.content.page-maker.index');
            Route::get('/create', [PageMakerController::class, 'create'])->name('admin.content.page-maker.create');
            Route::post('/store', [PageMakerController::class, 'store'])->name('admin.content.page-maker.store');
            Route::get('/edit/{page}', [PageMakerController::class, 'edit'])->name('admin.content.page-maker.edit');
            Route::put('/update/{page}', [PageMakerController::class, 'update'])->name('admin.content.page-maker.update');
            Route::delete('/destroy/{page}', [PageMakerController::class, 'destroy'])->name('admin.content.page-maker.destroy');
            Route::get('/status/{page}', [PageMakerController::class, 'status'])->name('admin.content.page-maker.status');
        });

        Route::prefix('post')->group(function () {

            Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}', [PostController::class, 'status'])->name('admin.content.post.status');
            Route::get('/commentable/{post}', [PostController::class, 'commentable'])->name('admin.content.post.commentable');
        });
    });

    Route::prefix('user')->namespace('User')->group(function () {

        Route::prefix('admin')->group(function () {

            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin.store');
            Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.user.admin.edit');
            Route::put('/update/{user}', [AdminUserController::class, 'update'])->name('admin.user.admin.update');
            Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.admin.destroy');
            Route::get('/activation/{user}', [AdminUserController::class, 'activation'])->name('admin.user.admin.activation');
            Route::get('/status/{user}', [AdminUserController::class, 'status'])->name('admin.user.admin.status');
            Route::get('role/{user}', [AdminUserController::class, 'role'])->name('admin.user.admin.role');
            Route::post('addRole/{user}', [AdminUserController::class, 'addRole'])->name('admin.user.admin.addRole');
            Route::get('permission/{user}', [AdminUserController::class, 'permission'])->name('admin.user.admin.permission');
            Route::post('addPermission/{user}', [AdminUserController::class, 'addPermission'])->name('admin.user.admin.addPermission');
        });

        Route::prefix('customer')->group(function () {

            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('admin.user.customer.activation');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
        });

        Route::prefix('role')->group(function () {

            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
            Route::get('/show-permission/{role}', [RoleController::class, 'permission'])->name('admin.user.role.permission');
            Route::put('/update-permission/{role}', [RoleController::class, 'updatePermission'])->name('admin.user.role.update-permission');
        });


        Route::prefix('permission')->group(function () {

            Route::get('/', [PermissionController::class, 'index'])->name('admin.user.permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('admin.user.permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('admin.user.permission.store');
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');
        });
    });


    Route::prefix('notify')->namespace('Notify')->group(function () {

        Route::prefix('email')->group(function () {

            Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email.index');
            Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
            Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
            Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
            Route::put('/update/{email}', [EmailController::class, 'update'])->name('admin.notify.email.update');
            Route::delete('/destroy/{email}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
            Route::get('/status/{email}', [EmailController::class, 'status'])->name('admin.notify.email.status');
            Route::get('/send/{email}', [EmailController::class, 'sendMail'])->name('admin.notify.email.sendMail');
        });

        Route::prefix('email-file')->group(function () {

            Route::get('/{email}', [EmailFileController::class, 'index'])->name('admin.notify.email-file.index');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('admin.notify.email-file.create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('admin.notify.email-file.store');
            Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('admin.notify.email-file.edit');
            Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('admin.notify.email-file.update');
            Route::delete('/destroy/{file}', [EmailFileController::class, 'destroy'])->name('admin.notify.email-file.destroy');
            Route::get('/status/{file}', [EmailFileController::class, 'status'])->name('admin.notify.email-file.status');
            Route::get('/download/{file}', [EmailFileController::class, 'download'])->name('admin.notify.email-file.download');
            Route::get('/see/{file}', [EmailFileController::class, 'seeFile'])->name('admin.notify.email-file.seeFile');
        });

        Route::prefix('sms')->group(function () {

            Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
            Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
            Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');
            Route::get('/send/{sms}', [SMSController::class, 'sendSms'])->name('admin.notify.sms.send-sms');
        });
    });

    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        Route::prefix('category')->group(function () {

            Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket.category.index');
            Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.category.create');
            Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{ticketCategory}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{ticketCategory}', [TicketCategoryController::class, 'update'])->name('admin.ticket.category.update');
            Route::delete('/destroy/{ticketCategory}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{ticketCategory}', [TicketCategoryController::class, 'status'])->name('admin.ticket.category.status');
        });

        Route::prefix('priority')->group(function () {

            Route::get('/', [TicketPriorityController::class, 'index'])->name('admin.ticket.priority.index');
            Route::get('/create', [TicketPriorityController::class, 'create'])->name('admin.ticket.priority.create');
            Route::post('/store', [TicketPriorityController::class, 'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{ticketPriority}', [TicketPriorityController::class, 'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{ticketPriority}', [TicketPriorityController::class, 'update'])->name('admin.ticket.priority.update');
            Route::delete('/destroy/{ticketPriority}', [TicketPriorityController::class, 'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{ticketPriority}', [TicketPriorityController::class, 'status'])->name('admin.ticket.priority.status');
        });

        Route::prefix('admin')->group(function () {

            Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
            Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');
        });

        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::get('/change/{ticket}', [TicketController::class, 'change'])->name('admin.ticket.change');


    });



    Route::prefix('setting')->namespace('Setting')->group(function () {

        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
    });


    Route::post('/notification/readAll', [NotificationController::class, 'readAll'])->name('admin.notification.readAll');
});



Route::prefix('auth')->group(function () {

    Route::prefix('panel')->group(function(){

        Route::get('/login',[LoginController::class , 'login'])->name('auth.panel.login');
        Route::post('/authenticate', [LoginController::class , 'authenticate'])->name('auth.panel.authenticate');
        Route::get('/logout', [LoginController::class , 'logout'])->name('auth.panel.logout');

    });



    Route::get('/login-register-form', [LoginRegisterController::class, 'LoginRegisterForm'])->name('auth.customer.login-register-form');
    Route::post('/login-register', [LoginRegisterController::class, 'LoginRegister'])->middleware('throttle:login-register-limiter')->name('auth.customer.login-register');


    Route::get('/login-register-confirm/{token}', [LoginRegisterController::class, 'LoginRegisterConfirm'])->name('auth.customer.login-register-confirm');
    Route::post('/login-confirm/{token}', [LoginRegisterController::class, 'LoginConfirm'])->middleware('throttle:login-confirm-limiter')->name('auth.customer.login-confirm');


    Route::get('login-resend-otp/{token}', [LoginRegisterController::class, 'resendOtp'])->middleware('throttle:login-resend-limiter')->name('auth.customer.login-resend-otp');
    Route::get('logout', [LoginRegisterController::class, 'logout'])->name('auth.customer.logout');
});



Route::get('/', [HomeController::class, 'home'])->name('customer.home');
Route::get('/products/{category?}', [HomeController::class, 'products'])->name('customer.products');
Route::get('/page/{page:slug}', [HomeController::class, 'page'])->name('customer.page');




Route::prefix('product')->controller(CustomerProductController::class)->group(function () {

    Route::get('/{product}', 'product')->name('customer.market.product');
    Route::post('/addComment/{product}', 'addComment')->name('customer.market.product.addComment');
    Route::get('/addToFavorite/{product}', 'addToFavorite')->name('customer.market.product.addToFavorite');
    Route::post('/addRate/{product}', 'addRate')->name('customer.market.product.addRate');
});



//sell bascket
Route::prefix('salesProcess')->group(function () {

    Route::controller(CartController::class)->group(function () {

        Route::get('/cart', 'cart')->name('customer.salesProcess.cart');
        Route::post('/cart/update', 'updateCart')->name('customer.salesProcess.updateCart');
        Route::post('/addToCart/{product}', 'addToCart')->name('customer.salesProcess.addToCart');
        Route::get('/removeFromCart/{cartItem}', 'removeFromCart')->name('customer.salesProcess.removeFromCart');
    });

    //address and delivery
    Route::middleware('profile.complete')->group(function () {

        Route::get('/address-and-delivery', [AddressController::class, 'addressAndDelivery'])->name('customer.salesProcess.address-and-delivery');
        Route::post('/add-address', [AddressController::class, 'addAddress'])->name('customer.salesProcess.add-address');
        Route::put('/update-address/{address}', [AddressController::class, 'updateAddress'])->name('customer.salesProcess.update-address');
        Route::get('/address/getCities/{province}', [AddressController::class, 'getCities'])->name('customer.salesProcess.getCities');
        Route::post('/chooseAddressDelivery', [AddressController::class, 'chooseAddressDelivery'])->name('customer.salesProcess.chooseAddressDelivery');
    });

    //payment

    Route::controller(CustomerPaymentController::class)->group(function () {

        Route::get('/payment', 'payment')->name('customer.salesProcess.payment');
        Route::post('/payment/copanDiscount', 'copanDiscount')->name('customer.salesProcess.payment.copanDiscount');
        Route::post('/payment/paymentSubmit', 'paymentSubmit')->name('customer.salesProcess.payment.paymentSubmit');
    });


    //profile
    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile', 'profile')->name('customer.salesProcess.profile');
        Route::post('/profile/complete', 'completeProfile')->name('customer.salesProcess.profile.completeProfile');
    });

});


Route::prefix('profile')->group(function () {


//profileOrder
Route::controller(ProfileOrderController::class)->group(function () {

    Route::get('orders', 'index')->name('customer.profileOrder.index');
});



//profile-favorites
Route::controller(FavoriteController::class)->group(function () {

    Route::get('favorites', 'index')->name('customer.profile.profile-favorites.index');
    Route::get('removeToFavorite/{product}', 'removeToFavorites')->name('customer.profile.profile-favorites.remove-to-favorites');
});


//profile-address
Route::controller(ProfileAddressController::class)->group(function () {

    Route::get('addresses', 'addresses')->name('customer.profile.addresses');
});



//profile-tickets
Route::controller(CustomerTicketController::class)->group(function () {

    Route::get('tickets', 'index')->name('customer.profile.ticket.index');
    Route::get('showTicket/{ticket}', 'showTicket')->name('customer.profile.ticket.showTicket');
    Route::get('changeStatus/{ticket}', 'changeStatus')->name('customer.profile.ticket.changeStatus');
    Route::post('answerTicket/{ticket}', 'answerTicket')->name('customer.profile.ticket.answerTicket');
    Route::get('addTicket', 'createTicket')->name('customer.profile.ticket.createTicket');
    Route::post('storeTicket', 'storeTicket')->name('customer.profile.ticket.storeTicket');
    Route::post('ticketFile/download/{ticket}' , 'download')->name('customer.profile.ticket.downloadFile');
});



//user-profile
Route::controller(UserProfileController::class)->group(function () {

    Route::get('', 'index')->name('customer.profile.index');
    Route::put('update', 'update')->name('customer.profile.update');
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
