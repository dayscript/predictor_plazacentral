@extends('layouts.app')

@section('title')
    {{ __('menu.prizes') }} @parent
@endsection

@section('content')
<div class="page">
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('menu.prizes') }}
                </div>
            </div>
        </div>
    </div>
    <div class="padding-30">
        <div class="row">
            <div class="medium-9 columns">
                <div class="row margin-30">
                    <div class="columns medium-6"><img :src="'img/prizes/' + $store.state.lang + '/1.jpg'" alt="1"></div>
                    <div class="columns medium-6"><img :src="'img/prizes/' + $store.state.lang + '/2.jpg'" alt="1"></div>
                </div>
                <div class="row margin-30">
                    <div class="columns medium-6"><img :src="'img/prizes/' + $store.state.lang + '/3.jpg'" alt="1"></div>
                    <div class="columns medium-6"><img :src="'img/prizes/' + $store.state.lang + '/4.jpg'" alt="1"></div>
                </div>
            </div>
            <div class="medium-3 columns text-center banner">
                @include('ads.vertical')
            </div>
        </div>
    </div>
</div>
@endsection