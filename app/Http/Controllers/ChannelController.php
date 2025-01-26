<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function getChannel($channel_id)
    {
        return response()->json([
            'channel_id' => $channel_id,
            'status' => 'success'
        ]);
    }
}