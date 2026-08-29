<?php

use App\Http\Controllers\Api\V1\User\OrderCancellationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['CheckLang', 'auth:api', 'custom.jwt'])
    ->post('/user/cancel/order/{id}', [OrderCancellationController::class, 'cancel']);
