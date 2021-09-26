<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LandlordController;
use App\Http\Controllers\Admin\LandlordPaymentController;
use App\Http\Controllers\Admin\LeaseController;
use App\Http\Controllers\Admin\LeaseHistoryController;
use App\Http\Controllers\Admin\ManagePermissionsController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyUnitController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UnpaidInvoicesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\IncomeController;
use App\Http\Controllers\User\InvoiceController as TenantInvoiceController;
use App\Http\Controllers\User\LeaseController as TenantLeaseController;
use App\Http\Controllers\User\PropertyController as LandlordPropertyController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin');

Route::get('lang/{locale}', function ($locale) {

    setting(['app_locale' => $locale]);
    setting()->save();
    return redirect()->back();
});

Route::prefix('admin')->middleware(['role:admin|staff|agent'])->name('admin.')->group(function () {

    Route::get('/generate-invoice',\App\Http\Controllers\GenerateInvoiceController::class)->name('generate-invoice.command');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('chat', ChatController::class)->name('chat');
    Route::get('report/deposits', DepositController::class)->name('report.deposit');
    Route::get('report/payment/landlord', LandlordPaymentController::class)->name('report.payment.landlord');
    Route::get('report/invoice/unpaid', UnpaidInvoicesController::class)->name('report.invoice.unpaid');
    Route::resource('tenant', TenantController::class)->except('update');
    Route::get('tenant/{tenant}/delete', 'App\Http\Controllers\Admin\TenantController@delete')->name('tenant.delete');
    Route::get('tenant/deactivated', [TenantController::class, 'deactivated'])->name('tenant.deactivated');
    Route::resource('calendar', CalendarController::class)->only('index');
    Route::resource('landlord', LandlordController::class)->except('update');
    Route::resource('property', PropertyController::class)->except('store', 'update');
    Route::resource('property-unit', PropertyUnitController::class)->except('store', 'update');
    Route::resource('ticket', TicketController::class)->only('index', 'create', 'show');
    Route::resource('manage-user', UserController::class);
    Route::get('manage-permission/{id}', ManagePermissionsController::class)->name('manage-permissions');
    Route::get('settings', SettingsController::class)->name('settings');
    Route::get('lease/expiring', [LeaseController::class, 'expiring'])->name('lease.expiring');
    Route::resource('lease', LeaseController::class)->except('store');
    Route::resource('lease-history', LeaseHistoryController::class)->only('index', 'destroy');
    Route::resource('inventory', InventoryController::class)->except('store', 'update');
    Route::resource('invoice', InvoiceController::class)->except('store', 'update');

});

Route::prefix('user')->middleware(['role:tenant|landlord|user'])->name('user.')->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserHomeController::class, 'profile'])->name('home');
    Route::get('/profile', [UserHomeController::class, 'profile'])->name('profile');
    Route::get('/income', IncomeController::class)->name('income');
    Route::resource('invoice', TenantInvoiceController::class)->only('index', 'show');
    Route::resource('lease', TenantLeaseController::class)->only('index', 'show');
    Route::resource('property', LandlordPropertyController::class)->only('index', 'show');
    Route::resource('ticket', UserTicketController::class);
});

Auth::routes([
    'register' => false,
]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
    ->middleware(['role:admin'])->name('admin.logs');
