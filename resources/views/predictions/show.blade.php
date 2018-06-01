@extends('layouts.app')

@section('title')
    {{ __('predictions.predictions') }} @parent
@endsection
@section('meta')
    <meta property="og:url" content="{{ url('predictions/'.$prediction->id) }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@lang('predictions.share_group_title',['group'=>$prediction->group->name])"/>
    <meta property="og:description" content="@lang('predictions.share_group_description')"/>
    <meta property="og:image" content="{{ url('images/predictions/'.$prediction->group_id . '/' . $prediction->first_team_id . '/' . $prediction->second_team_id) }}"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="315"/>
    <meta property="fb:app_id" content="941902379280971"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dayscript">
    <meta name="twitter:creator" content="@dayscript">
    <meta name="twitter:title" content="@lang('predictions.share_group_title',['group'=>$prediction->group->name])">
    <meta name="twitter:description" content="@lang('predictions.share_group_description')">
    <meta name="twitter:image" content="{{ url('images/predictions/'.$prediction->group_id . '/' . $prediction->first_team_id . '/' . $prediction->second_team_id) }}">
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
                    <img src="{{ url('images/predictions/'.$prediction->group_id . '/' . $prediction->first_team_id . '/' . $prediction->second_team_id) }}" alt="">
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