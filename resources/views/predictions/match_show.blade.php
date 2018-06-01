@extends('layouts.app')

@section('title')
    {{ __('predictions.predictions') }} @parent
@endsection
@section('meta')
    <meta property="og:url" content="{{ url('matchpredictions/'.$prediction->id) }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@lang('predictions.share_match_title',['match'=>$prediction->match->versus])"/>
    <meta property="og:description" content="@lang('predictions.share_match_description')"/>
    <meta property="og:image" content="{{ url('images/matchpredictions/'.$prediction->match_id . '/' . ($prediction->local_score ?? 0) . '/' .  ($prediction->visit_score ?? 0)) }}"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="315"/>
    <meta property="fb:app_id" content="941902379280971"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dayscript">
    <meta name="twitter:creator" content="@dayscript">
    <meta name="twitter:title" content="@lang('predictions.share_match_title',['match'=>$prediction->match->versus])">
    <meta name="twitter:description" content="@lang('predictions.share_match_description')">
    <meta name="twitter:image" content="{{ url('images/matchpredictions/'.$prediction->match_id . '/' . ($prediction->local_score ?? 0) . '/' . ($prediction->visit_score ?? 0)) }}">
@endsection
@section('content')
    <div class="page">
        <div class="section">
            <div class="row">
                <div class="medium-8 columns text-left">
                    <div class="title-section">
                        @lang('predictions.predictions')
                    </div>
                </div>
            </div>
        </div>
        <div class="padding-30">
            <div class="row">
                <div class="medium-6 columns">
                    <img src="{{ url('images/matchpredictions/'.$prediction->match_id . '/' . ($prediction->local_score ?? 0) . '/' . ($prediction->visit_score ?? 0)) }}" alt="">
                </div>
                <div class="columns medium-6">
                    <div class="info small">
                        <h2>{{ $prediction->user->fullName }}</h2><hr>
                        <div><strong>@lang('predictions.predictions'):</strong> {{ $prediction->user->predictions->count() }}</div>
                        <div><strong>@lang('predictions.total_points'):</strong> {{ $prediction->user->points }}</div>
                        <div><strong>@lang('leagues.leagues'):</strong> {{ $prediction->user->leagues->count() }}</div><hr>
                        <a href="/predictions" class="button">@lang('menu.play')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection