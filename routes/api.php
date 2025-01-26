<?php

use Illuminate\Routing\Route;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\YouTubeController;

Route::get('/channel/{channel_id}', [ChannelController::class, 'getChannel'])->name('getChannel');
Route::get('/youtube/{channel_id}', [YouTubeController::class, 'getRecentVideos'])->name('getRecentVideos');
Route::get('/youtube/stats/{channel_id}', [YouTubeController::class, 'getChannelStatistics'])->name('getChannelStatistics');