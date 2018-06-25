@extends('layouts.app')

@section('title')
    {{ __('menu.my_predictions') }} @parent
@endsection

@section('content')
    <div class="page">
        <predictions-index active="{{ $active }}" :groups="{{ $groups }}" :total="{{ auth()->user()->points }}"></predictions-index>
        <div class="row" style="text-align: center;padding-bottom: 15px">
            <div class="text-center margin-30">
                <img src="/img/banners/728x90.jpg" alt="" class="Add">
            </div>
        </div>
    </div>
@endsection
