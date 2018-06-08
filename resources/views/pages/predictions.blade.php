@extends('layouts.app')

@section('title')
    {{ __('menu.my_predictions') }} @parent
@endsection

@section('content')
    <predictions-index :groups="{{ $groups }}"></predictions-index>
@endsection