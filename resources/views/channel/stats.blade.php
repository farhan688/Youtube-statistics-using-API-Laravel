@extends('layouts.app')

@section('title', 'Channel Statistics')

@section('content')
<div class="stats-container">
    <div class="search-box">
        <form action="{{ route('channel.show') }}" method="GET">
            <input type="text" name="channel_id" placeholder="Enter YouTube Channel ID" class="search-input">
            <button type="submit" class="search-button">Get Stats</button>
        </form>
    </div>

    @if(isset($channelStats))
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Channel Name</h3>
            <p>{{ $channelStats['channel_name'] ?? $channelStats->channel_name ?? 'N/A' }}</p>
        </div>
        <div class="stat-card">
            <h3>Subscribers</h3>
            <p>{{ number_format($channelStats['subscribers'] ?? $channelStats->subscribers ?? 0) }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Views</h3>
            <p>{{ number_format($channelStats['total_views'] ?? $channelStats->total_views ?? 0) }}</p>
        </div>
        <div class="stat-card">
            <h3>Videos</h3>
            <p>{{ number_format($channelStats['total_videos'] ?? $channelStats->total_videos ?? 0) }}</p>
        </div>
    </div>

    @if(isset($recentVideos))
    <div class="videos-container">
        <h2>Recent Videos</h2>
        <div class="videos-grid">
            @foreach(($recentVideos['videos'] ?? $recentVideos->videos ?? []) as $video)
            <div class="video-card">
                <h3>{{ $video['title'] ?? $video->title ?? 'N/A' }}</h3>
                <p>Published: {{ \Carbon\Carbon::parse($video['published_at'] ?? $video->published_at)->format('M d, Y') }}</p>
                <a href="{{ $video['url'] ?? $video->url ?? '#' }}" target="_blank" class="video-link">Watch Video</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endif
</div>
@endsection
