<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountStatementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\InternalTransferController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\ExchangeRateController;
use App\Models\CurrencyExchange;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/notifications/count', function () {
    return response()->json([
        'count' => Auth::user()->unreadNotifications->count(),
    ]);
})->name('notifications.count');


Route::post('/notifications/mark-as-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
})->name('notifications.markAsRead');



    // setup pin
    Route::get('/wallet/setup-pin', [WalletController::class, 'showSetupPinForm'])->name('wallet.setupPin');
    Route::post('/wallet/setup-pin', [WalletController::class, 'setupPin'])->name('wallet.storePin');

    // reset-pin
    Route::get('/wallet/reset-pin', [WalletController::class, 'showResetPinForm'])->name('wallet.pin.reset.form');
    Route::post('/wallet/reset-pin', [WalletController::class, 'resetPin'])->name('wallet.resetPin');

  // Verfication
  Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
  Route::get('/verify/email', [VerificationController::class, 'emailVerificationShow'])->name('verify.email');
  Route::post('/verify/email', [VerificationController::class, 'sendEmailVerification'])->name('verify.email.send');
  Route::post('/users/update-cnic-status', [UserController::class, 'updateCnicStatus'])->name('users.update-cnic-status');
  

// logout
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

Route::get('/exchange-rate/{paymentMethod}', [ExchangeRateController::class, 'getRate'])->name('exchange-rate.getRate');

Route::middleware(['auth','check.wallet.pin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{id}',[ProfileController::class,'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.change');

   
    
    // Deposits
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
    Route::get('/deposit/{slug}', [DepositController::class, 'showAccountDetails'])->name('deposit.accountdetails');
    Route::post('/deposit/store', [DepositController::class, 'store'])->name('deposit.store');

    // Withdraw 
    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
    Route::get('/withdraw/{slug}', [WithdrawController::class, 'showAccountDetails'])->name('withdraw.view');
    Route::post('/withdrawals', [WithdrawController::class, 'store'])->name('withdraw.store');

   
    // Internal Transfer
    Route::get('/internaltransfer', [InternalTransferController::class, 'index'])->name('internal-transfer.index');
    Route::post('/internal-transfer', [InternalTransferController::class, 'transfer'])->name('internal-transfer');
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    
    // Currency Converter
    Route::get('/currency-exchange', [CurrencyExchangeController::class, 'index'])->name('currency-exchange.index');
    Route::post('/currency-exchange', [CurrencyExchangeController::class, 'exchange'])->name('currency-exchange.convert');   
    
    // Exchange Rate
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange.index');
    Route::get('/exchange-rates/{id}/edit', [ExchangeRateController::class, 'edit'])->name('exchange-rates.edit');
    Route::put('/exchange-rates/{id}', [ExchangeRateController::class, 'update'])->name('exchange-rates.update');

    Route::get('/invite', [InviteController::class, 'index'])->name('invite.index');

  
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

    Route::get('/verify/phone', [VerificationController::class, 'phoneVerificationShow'])->name('verify.phone');
    Route::post('/send-verification-code', [VerificationController::class, 'sendCode'])->name('send.verification.code');
    Route::post('/verify-phone', [VerificationController::class, 'verifyCode'])->name('verify.phone.store');
    
    Route::get('/verify/identity', [VerificationController::class, 'identityVerificationShow'])->name('verify.identity');
    Route::post('/verify/identity', [VerificationController::class, 'identityVerification'])->name('verify.identity.store');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('deposite.index');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setuppin', [AccountController::class, 'index'])->name('setuppin.index');
    
    //  Account Statements
    Route::get('/account-statements', [AccountStatementController::class, 'index'])->name('account-statements.index');
    Route::post('/account-statements', [AccountStatementController::class, 'store'])->name('account-statements.store');
    Route::get('/account/view-statement', [AccountStatementController::class, 'view'])->name('accountstatement.view');
    Route::delete('/account-statements/{id}', [AccountStatementController::class, 'destroy'])->name('account-statements.destroy');
    
    Route::post('/account-statements/{id}/approve', [AccountStatementController::class, 'approve'])->name('account-statements.approve');
    Route::post('/account-statements/{id}/reject', [AccountStatementController::class, 'reject'])->name('account-statements.reject');

    // Setting
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    
    


  
    //  ----- ADMIN ROUTES ------ //
    Route::middleware(['auth','role:admin'])->group(function () {
        // Payment Methods
        Route::get('/paymentmethod', [PaymentMethodController::class, 'index'])->name('paymentmethod.index');
        Route::get('/paymentmethod/create', [PaymentMethodController::class, 'create'])->name('paymentmethod.create');
        Route::post('/paymentmethod', [PaymentMethodController::class, 'store'])->name('paymentmethod.store');
        Route::delete('/paymentmethod/{id}', [PaymentMethodController::class, 'destroy'])->name('paymentmethod.destroy');
        Route::get('/paymentmethod/{id}/edit', [PaymentMethodController::class, 'edit'])->name('paymentmethod.edit');
        Route::put('/paymentmethod/{id}', [PaymentMethodController::class, 'update'])->name('paymentmethod.update');
    });

    Route::middleware(['auth','role:customer'])->group(function () {
        //
    });
});

require __DIR__.'/auth.php';
