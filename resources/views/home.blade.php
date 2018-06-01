@extends('layouts.app')

@section('title')
    {{ __('menu.home') }} @parent
@endsection

@section('content')
    @include('layouts.partials.banner')
    <div class="row margin-60">
        <div class="medium-9 columns">
            <div class="row">
                <div class="medium-6 columns">
                    <h2 class="title">@{{ $store.getters.trans('matches.next_matches') }}</h2>
                    @foreach($matches as $match)
                    <div class="row columns item {{ $loop->index%2?'':'dark' }}">
                        <div class="medium-3 columns fecha text-left">
                            {{ $match->date }}
                        </div>
                        <div class="medium-9 columns equipos text-center">
                            <div class="row">
                                <div class="small-4 columns team text-right">
                                    {{ $store.getters.trans('teams.<?= str_slug($match->localId->name) ?>') }}
                                </div>
                                <div class="small-4 columns text-center">
                                    <img src="/storage/{{ $match->localId->image }}" alt="{{ $match->localId->name }}" class="flag thumbnail circle" width="40">&nbsp;<img src="/storage/{{ $match->visitId->image }}" alt="{{ $match->visitId->name }}" class="flag thumbnail circle" width="40">
                                </div>
                                <div class="small-4 columns team text-left">
                                    {{ $store.getters.trans('teams.<?= str_slug($match->visitId->name) ?>') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <a href="/predictions" class="button expanded">@{{ $store.getters.trans('matches.predict') }}</a>
                </div>
                <div class="medium-6 columns">
                    <h2 class="title">@{{ $store.getters.trans('game.general_ranking') }}</h2>
                    @foreach($users as $user)
                    <div class="row columns item {{ $loop->index%2?'':'dark' }}">
                        <div class="small-1 columns posicion text-left">
                            {{ $loop->iteration }}.
                        </div>
                        <div class="small-9 columns jugador text-left">
                            {{ $user->fullName }}
                        </div>
                        <div class="small-2 columns puntaje text-right">
                            {{ $user->points }}
                        </div>
                    </div>
                    @endforeach
                    <a href="#" class="button expanded">@{{ $store.getters.trans('game.see_all') }}</a>
                </div>
            </div>
        </div>
        <div class="medium-3 columns">
            @include('ads.vertical')
        </div>
    </div>

@endsection
