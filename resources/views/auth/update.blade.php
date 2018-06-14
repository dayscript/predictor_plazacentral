@extends('layouts.pass')
@section('title')
    {{ __('users.register') }} @parent
@endsection
@section('content')
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('users.register') }}
                </div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="/update">
        {{ csrf_field() }}
        <div class="row padding-30">
            <div class="medium-9 columns">
                <div class="row">
                    <div class="medium-6 columns">
                        <label>@{{ $store.getters.trans('users.identification_type') }}
                            @php($types = collect(['CC'=>'Cédula de ciudadanía','CE'=>'Cédula de extranjería','PASSPORT'=>'Pasaporte']))
                            <select name="identification_type" class="{{ $errors->has('identification_type') ? ' is-invalid-input' : '' }}">
                                @foreach($types as $key=>$type)
                                    <option {{ ($key==old('identification_type','CC'))?'selected':'' }} value="{{ $key }}">{{ $store.getters.trans('users.identification_type_<?= $key ?>') }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('identification_type'))
                                <span class="form-error is-visible">{{ $errors->first('identification_type') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.identification') }}
                            <input type="text" name="identification" class="{{ $errors->has('identification') ? ' is-invalid-input' : '' }}" value="{{ $users->identification }}" required autofocus>
                            @if ($errors->has('identification'))
                                <span class="form-error is-visible">{{ $errors->first('identification') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.names') }}
                            <input type="text" name="name" class="{{ $errors->has('name') ? ' is-invalid-input' : '' }}" value="{{ $users->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="form-error is-visible">{{ $errors->first('name') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.last_names') }}
                            <input type="text" name="last" class="{{ $errors->has('last') ? ' is-invalid-input' : '' }}" value="{{ $users->last }}">
                            @if ($errors->has('last'))
                                <span class="form-error is-visible">{{ $errors->first('last') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.email') }}
                            <input type="email" name="email" class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" value="{{ $users->email }}" required>
                            @if ($errors->has('email'))
                                <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.phone') }}
                            <input type="text" name="phone" class="{{ $errors->has('phone') ? ' is-invalid-input' : '' }}" value="{{ $users->phone }}">
                            @if ($errors->has('phone'))
                                <span class="form-error is-visible">{{ $errors->first('phone') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>@{{ $store.getters.trans('users.country') }}
                            @php($countries = App\Http\Utilities\Country::all())
                            <select name="country" class="{{ $errors->has('country') ? ' is-invalid-input' : '' }}">
                                @foreach($countries as $key=>$country)
                                    <option {{ ($key==old('country','CO'))?'selected':'' }} value="{{ $key }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="form-error is-visible">{{ $errors->first('country') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>@{{ $store.getters.trans('users.city') }}
                            <select name="city">
                                @php($cities = \App\User::cities())
                                <option value="" {{ old('city','Bogotá')==''?'selected':'' }}>@{{ $store.getters.trans('simple.select') }}</option>
                                @foreach($cities as $key=>$dept)
                                    <optgroup label="{{ $key }}">
                                        @foreach($dept as $city)
                                            <option value="{{ $city }}" {{ old('city','Bogotá')==$city?'selected':'' }}>{{ $city }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @if ($errors->has('city'))
                                <span class="form-error is-visible">{{ $errors->first('city') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.password') }}
                            <input type="password" name="password" class="{{ $errors->has('password') ? ' is-invalid-input' : '' }}" required>
                            @if ($errors->has('password'))
                                <span class="form-error is-visible">{{ $errors->first('password') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            @{{ $store.getters.trans('users.confirm_password') }}
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </label>
                    </div>
                </div>
                <fieldset class="row columns hide">
                    <legend>@{{ $store.getters.trans('users.gender') }}</legend>
                    <input type="radio" name="gender" value="M" id="gender_m" {{ old('gender','M')=='M'?'checked':'' }}><label for="gender_m">@{{ $store.getters.trans('users.gender_m') }}</label>
                    <input type="radio" name="gender" value="F" id="gender_f" {{ old('gender','M')=='F'?'checked':'' }}><label for="gender_f">@{{ $store.getters.trans('users.gender_f') }}</label>
                    @if ($errors->has('gender'))
                        <span class="form-error is-visible">{{ $errors->first('gender') }}</span>
                    @endif
                </fieldset>
                <hr>
                <div class="row columns">
                    <p>@{{ $store.getters.trans('users.do_you_like_promotions') }}</p>
                    <input id="promotions" name="promotions" type="checkbox" {{ old('promotions')?'checked':'' }} value="1"><label for="promotions">@{{ $store.getters.trans('users.yes_i_want_promotions') }}</label>
                </div>
                <hr>
                <div class="row columns">
                    <p v-html="$store.getters.trans('users.accept_tyc')"></p>
                </div>
                <button type="submit" class="button expanded">@{{ $store.getters.trans('users.accept_and_continue') }}</button>
            </div>
            <div class="medium-3 columns hide-for-small-only">
                @include('ads.vertical')
            </div>
        </div>
    </form>
@endsection
