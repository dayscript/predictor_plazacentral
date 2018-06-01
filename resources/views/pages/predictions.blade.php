@extends('layouts.app')

@section('title')
    {{ __('menu.my_predictions') }} @parent
@endsection

@section('content')
    <predictions-index message="{{ $message }}" :groups="{{ $groups }}"></predictions-index>
    @include('ads.horizontal')
@endsection