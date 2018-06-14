@extends('layouts.app')

@section('title')
    {{ __('users.my_account') }} @parent
@endsection

@section('content')
<div class="page">
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('users.my_account') }}
                </div>
            </div>
        </div>
    </div>
    <div class="padding-30">
        <div class="row">
            <div class="medium-9 columns">
                <div class="info">
                    <h4 class="title">@{{ $store.getters.trans('users.my_personal_information') }}</h4>
                    <div class="row">
                        <div class="medium-6 columns">
                            <div class="section-title">@{{ $store.getters.trans('users.summary') }}</div>
                            <div class="usuario">
                                <strong>{{ $user->full_name }}</strong> <br>@{{ $store.getters.trans('users.email') }}: <strong>{{ $user->email }}</strong> <br>@{{ $store.getters.trans('users.country') }}: <strong>{{ $user->country }}</strong> <br>@{{ $store.getters.trans('users.city') }}: <strong>{{ $user->city }}</strong> <br>@{{ $store.getters.trans('users.register_date') }}: <strong>{{ $user->created_at }}</strong>
                                <br>@{{ $store.getters.trans('users.last_login') }}: <strong> {{ $user->updated_at->diffForHumans() }}</strong>
                            </div>
                            <hr class="light">
                        </div>
                        <div class="medium-6 columns text-center" style="font-size: 2rem;">
                            @if($user->position)
                                <strong>@{{ $store.getters.trans('users.position') }}:</strong> <br>
                                {{ $user->position }}
                            @endif
                            {{--<change-password></change-password>--}}
                        </div>
                    </div>
                    {{--<hr class="light">--}}
                    {{--<h4 class="title">Resumen del juego</h4>--}}
                    {{--<game-summary :rounds="{{ $rounds }}" :leagues="{{ $leagues }}" userid="{{ $user->id }}" :userpoints="{{ $user->points }}"></game-summary>--}}
                </div>
            </div>
            <div class="medium-3 columns text-center banner">
                @include('ads.vertical')
            </div>
        </div>
    </div>
</div>
@endsection