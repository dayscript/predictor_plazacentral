@extends('layouts.app')

@section('title')
    {{ __('menu.rewards') }} @parent
@endsection

@section('content')
<div class="page">
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('menu.rewards') }}
                </div>
            </div>
        </div>
    </div>
    <div class="padding-30">
        <div class="row">
            <div class="medium-9 columns">
                <div class="info">
                    ssasa
                </div>
            </div>
            <div class="medium-3 columns text-center banner">
                @include('layouts.partials.ads')
            </div>
        </div>
    </div>
</div>
@endsection