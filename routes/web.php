<?php

use App\Http\Controllers\ChannelViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChannelViewController::class, 'index'])->name('channel.index');
Route::get('/channel', [ChannelViewController::class, 'show'])->name('channel.show');