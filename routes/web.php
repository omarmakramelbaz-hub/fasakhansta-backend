<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Dashboard\SettingsController;

Route::get('test-test', function () {
    Mail::send('emails.send_pending_vendor_acceptance_email', ['user' => 'fvxcvx', 'email' => 'abderhman.menem@gmail.com', 'mobile' => ['0103498598'], 'password' => '123456', 'account_type' => 'vendor'], function ($message) {
        $message->to('abderhman.menem@gmail.com');
        $message->subject('Send Notification');
    });
});

Route::get('/clear-cache', function() {
    $exitCode0 = Artisan::call('route:clear');
    $exitCode1 = Artisan::call('view:clear');
    $exitCode3 = Artisan::call('config:cache');
    $exitCode4 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode = Artisan::call('clear-compiled');
    return 'done';
});

Route::get('/clear-compiled', function() {
    $exitCode = Artisan::call('clear-compiled');
});

Route::get('/linkstoragse', function () {
    Artisan::call('storage:link');
});

use Illuminate\Support\Facades\Response;

Route::get('send_order_email',function(){
    $order = \App\Models\Order::whereIn('status',['pending'])->first();
    $email="Ahmed@email.com";
    $data=['email' => $email, 'cart' => $order];
    return view('emails.send_order_email',$data);
});

Route::get('/downloadApp', function () {
    $userAgent = request()->header('User-Agent');
    if (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
        return redirect()->away('https://apps.apple.com/us/app/fasakhaninja/id6741027064');
    } elseif (preg_match('/Android/i', $userAgent)) {
        return redirect()->away('https://play.google.com/store/apps/details?id=com.smartvision.faskhanista');
    } else{
        return redirect()->route('home');
    }
});

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\PusherController;

Route::group(['middleware' => 'lang'], function () {
    Route::post('/pusher/auth', function (Request $request) {
        if (Auth::check()) {
            $pusher = new Pusher\Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                ['cluster' => env('PUSHER_APP_CLUSTER')]
            );

            $socketId = $request->input('socket_id');
            $channelName = $request->input('channel_name');

            if ($channelName === 'private-user.' . Auth::id()) {
                $auth = $pusher->socket_auth($channelName, $socketId);
                return response()->json(json_decode($auth));
            }

            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    });

    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/term-conditions',[HomeController::class,'terms'])->name('terms');
    Route::get('/about-us',[HomeController::class,'aboutUs'])->name('aboutUs');
    Route::get('/contact-us',[HomeController::class,'contactus'])->name('contactus');
    Route::post('/store-contact',[HomeController::class,'storeContact'])->name('storeContact');
    Route::get('/screens',[HomeController::class,'screens'])->name('screens');
    Route::get('/features',[HomeController::class,'features'])->name('features');
    Route::get('/subscriber-store',[HomeController::class,'storeSubscriber'])->name('subscriber.store');
    Route::get('/pay-thanks',[HomeController::class,'paySuccess'])->name('paySuccess');
    Route::get('/pay-false',[HomeController::class,'payFailed'])->name('payFailed');

    Route::middleware('IsAdmin')->prefix('admin')->group(function () {
        Route::get('/header-image', [SettingsController::class, 'headerImage'])->name('admin.headerImage');
        Route::put('/header-image/update', [SettingsController::class, 'updateHeaderImage'])->name('admin.headerImage.update');
    });
});
