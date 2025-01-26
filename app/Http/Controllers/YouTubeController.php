<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YouTubeController extends Controller
{
    public function getRecentVideos($channel_id)
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $url = "https://www.googleapis.com/youtube/v3/search?key={$apiKey}&channelId={$channel_id}&part=snippet&order=date&maxResults=2";

        $response = Http::get($url);

        if ($response->successful()) {
            $videos = [];
            foreach ($response->json()['items'] as $item) {
                $videos[] = [
                    'title' => $item['snippet']['title'],
                    'published_at' => $item['snippet']['publishedAt'],
                    'url' => 'https://www.youtube.com/watch?v=' . $item['id']['videoId']
                ];
            }
            return response()->json(['videos' => $videos]);
        } else {
            return response()->json(['error' => 'Failed to retrieve videos'], 500);
        }
    }
    public function getChannelStatistics($channel_id)
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $url = "https://www.googleapis.com/youtube/v3/channels?key={$apiKey}&id={$channel_id}&part=snippet,statistics";

        $response = Http::get($url);

        if ($response->successful() && isset($response->json()['items'][0])) {
            $channel = $response->json()['items'][0];
            $statistics = [
                'channel_name' => $channel['snippet']['title'],
                'subscribers' => $channel['statistics']['subscriberCount'],
                'total_views' => $channel['statistics']['viewCount'],
                'total_videos' => $channel['statistics']['videoCount']
            ];
            return response()->json($statistics);
        } else {
            return response()->json(['error' => 'Channel not found or failed to retrieve statistics'], 404);
        }
    }
}