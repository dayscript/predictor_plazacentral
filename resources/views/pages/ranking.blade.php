@extends('layouts.app')

@section('title')
    {{ __('menu.ranking') }} @parent
@endsection

@section('content')
    @if($l)
        <ranking-index :rounds="{{ $rounds }}" :leagues="{{ $leagues }}" userid="{{ auth()->user()->id }}" :l="{{ $l }}" :r="{{ $r }}"></ranking-index>
    @else
        <ranking-index :rounds="{{ $rounds }}" :leagues="{{ $leagues }}" userid="{{ auth()->user()->id }}" :r="{{ $r }}"></ranking-index>
    @endif
@endsection