<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChannelViewController extends Controller
{
    public function index()
    {
        return view('channel.stats');
    }

    public function show(Request $request)
    {
        $channelId = $request->input('channel_id');

        if (!$channelId) {
            return view('channel.stats');
        }

        $youtubeController = new YouTubeController();

        $channelStats = json_decode(json_encode($youtubeController->getChannelStatistics($channelId)->getData()), true);
        $recentVideos = json_decode(json_encode($youtubeController->getRecentVideos($channelId)->getData()), true);

        return view('channel.stats', compact('channelStats', 'recentVideos'));
    }
}