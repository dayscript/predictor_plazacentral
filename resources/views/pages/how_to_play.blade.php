@extends('layouts.app')

@section('title')
    {{ __('menu.how_to_play') }} @parent
@endsection

@section('content')
<div class="page">
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('menu.how_to_play') }}
                </div>
            </div>
        </div>
    </div>
    <div class="padding-30">
        <div class="row">
            <div class="medium-9 columns">
                <div class="row">
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/1.jpg'" alt="1"></div>
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/2.jpg'" alt="1"></div>
                </div>
                <div class="row">
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/3.jpg'" alt="1"></div>
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/4.jpg'" alt="1"></div>
                </div>
                <div class="row">
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/5.jpg'" alt="1"></div>
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/6.jpg'" alt="1"></div>
                </div>
                <div class="row">
                    <div class="columns medium-6"><img :src="'img/instructions/' + $store.state.lang + '/7.jpg'" alt="1"></div>
                </div>
            </div>
            <div class="medium-3 columns text-center banner">
                @include('ads.vertical')
            </div>
        </div>
    </div>
</div>
@endsection