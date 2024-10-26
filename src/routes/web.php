<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\CommandController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    $response = Telegram::getMe();
    return $response;
});

Route::get("/telegram", [BotController::class,"index"]);
Route::get("/set-webhook", [BotController::class,"setWebhook"]);
Route::get('/handle', [BotController::class, 'handle'])->name("handle");
Route::get('/updated-activate', [BotController::class,'updated'])->name("updated");
Route::post('/telegram/webhook', [BotController::class,'main'])->name("main");
