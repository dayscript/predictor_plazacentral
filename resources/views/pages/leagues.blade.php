@extends('layouts.app')

@section('title')
    {{ __('menu.leagues') }} @parent
@endsection

@section('content')
    <div class="page">
        <div class="section">
            <div class="row">
                <div class="medium-12 columns text-left">
                    <div class="title-section">
                        @{{ $store.getters.trans('menu.leagues') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="padding-30">
            <div class="row">
                <div class="medium-9 columns">
                    <div class="ligas">
                        <div class="row">
                            <div class="medium-12 columns">
                                <ul class="tabs" data-active-collapse="false" data-tabs id="collapsing-tabs">
                                    <li class="tabs-title {{ !isset($option) || $option=='list'?'is-active':'' }}">
                                        <a href="#panel1c" aria-selected="true">@{{ $store.getters.trans('leagues.my_leagues') }}</a>
                                    </li>
                                    <li class="tabs-title {{ isset($option) &&  ($option=='create' || $option == 'edit')?'is-active':'' }}">
                                        <a href="#panel2c">@{{ $store.getters.trans('leagues.create_league') }}</a></li>
                                    <li class="tabs-title {{ isset($option) && $option=='join'?'is-active':'' }}">
                                        <a href="#panel3c">@{{ $store.getters.trans('leagues.join_leagues') }}</a></li>
                                </ul>
                                <div class="tabs-content" data-tabs-content="collapsing-tabs">
                                    <div class="tabs-panel {{ !isset($option) || $option=='list'?'is-active':'' }}" id="panel1c">
                                        <div class="row columns">
                                            <div class="item-title head">
                                                <div class="medium-6 columns encabezado text-left">@{{ $store.getters.trans('leagues.league') }}</div>
                                                <div class="medium-2  columns encabezado text-center">@{{ $store.getters.trans('leagues.users') }}</div>
                                                <div class="medium-2  columns encabezado text-center">@{{ $store.getters.trans('leagues.points') }}</div>
                                                <div class="medium-2  columns encabezado text-center">@{{ $store.getters.trans('leagues.options') }}</div>
                                            </div>
                                            @forelse($leagues as $league)
                                                @can('update', $league)
                                                    <league-summary :league="{{ $league }}" :editable="true" rowclass="{{ $loop->index%2?'dark':'' }}"></league-summary>
                                                @elsecannot('update',$league)
                                                    <league-summary :league="{{ $league }}" :editable="false" rowclass="{{ $loop->index%2?'dark':'' }}"></league-summary>
                                                @endcan
                                            @empty
                                                <div class="row item liga column" style="min-height: 100px;">
                                                    <div class="medium-12 columns text-center item-liga">@{{ $store.getters.trans('leagues.not_joined_any_leagues') }}</div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="tabs-panel {{ isset($option) && ($option=='create' || $option == 'edit')?'is-active':'' }}" id="panel2c">
                                        @if(isset($edit_league) && $edit_league)
                                            <league-create :league="{{ $edit_league }}"></league-create>
                                        @else
                                            <league-create></league-create>
                                        @endif
                                    </div>
                                    <div class="tabs-panel {{ isset($option) && $option=='join'?'is-active':'' }}" id="panel3c">
                                        @if(isset($code))
                                            <league-join :initialcode="'{{ $code }}'"></league-join>
                                        @else
                                            <league-join></league-join>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="medium-3 columns text-center banner">
                    @include('ads.vertical')
                </div>
            </div>
        </div>
    </div>
@endsection