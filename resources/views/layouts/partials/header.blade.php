<div class="header  sticky" data-sticky data-margin-top="0">
    <div class="row">
        <div class="medium-3 columns">
            <img class="logo" src="/img/logo.png" alt="">
        </div>
        <div class="medium-9 columns">
            <div class="barra" data-responsive-toggle="menu-predictor" data-hide-for="medium">
                <button class="menu-icon" type="button" data-toggle="menu-predictor"></button>
            </div>
            <div id="menu-predictor">
                <ul class="vertical medium-horizontal menu align-left">
                    <li><a class="active" href="/">@{{ $store.getters.trans('menu.home') }}</a></li>
                    <li><a href="/predictions">@{{ $store.getters.trans('menu.my_predictions') }}</a></li>
                    <li><a href="/leagues">@{{ $store.getters.trans('menu.leagues') }}</a></li>
                    <li><a href="/ranking">@{{ $store.getters.trans('menu.ranking') }}</a></li>
                    <li><a href="/how-to-play">@{{ $store.getters.trans('menu.how_to_play') }}</a></li>
                    <li><a href="/rewards">@{{ $store.getters.trans('menu.rewards') }}</a></li>
                    @auth
                        <li><a href="#" class="login" onclick="$('.login.in').slideToggle();"><i class="fi-torso"> </i> {{ auth()->user()->name }}</a></li>
                    @else
                        <li><a href="#" class="login" onclick="$('.login.out').slideToggle();">@{{ $store.getters.trans('menu.play') }}</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN -->
@auth
    <div class="login in">
        <div class="row">
            <div class="medium-3 columns">
                <div class="usuario">@{{ $store.getters.trans('users.hi') }}: <strong>{{ auth()->user()->fullName }}</strong></div>
            </div>
            <div class="medium-2 columns">
                <a href="/account" class="button expanded"><i class="far fa-user-circle"></i> @{{ $store.getters.trans('users.my_account') }}</a>
            </div>
            <div class="medium-2 columns end">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="button warning expanded"><i class="fi-x-circle"> </i> @{{ $store.getters.trans('users.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endauth
@guest
    <div class="login out {{ request()->is('login') || $errors->count()?'show':'' }}">
        <div class="row">
            <div class="medium-4 medium-offset-2 columns">
                <h2> @{{ $store.getters.trans('users.login') }}</h2>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="title">@{{ $store.getters.trans('users.do_you_have_an_account') }}</div>
                    <div class="small-12 columns">
                        <input type="email" name="email" :placeholder="$store.getters.trans('users.email')" value="{{ old('email') }}" class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" required autofocus/>
                        @if ($errors->has('email'))
                            <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="small-12 columns">
                        <input type="password" :placeholder="$store.getters.trans('users.password')" name="password" required class="{{ $errors->has('password') ? ' is-invalid-input' : '' }}"/>
                        @if ($errors->has('password'))
                            <span class="form-error is-visible">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="small-12 columns">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">@{{ $store.getters.trans('users.remember_me') }}</label>
                    </div>
                    <button type="submit" class="button expanded">@{{ $store.getters.trans('users.login') }}</button>
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="link">@{{ $store.getters.trans('users.forgot_my_password') }}</a>
                    </div>
                    <hr>
                    <div class="texto">@{{ $store.getters.trans('users.or_use_facebook') }}</div>
                    <a href="/login/facebook" class="button facebook expanded"><i class="fab fa-facebook"></i> @{{ $store.getters.trans('users.facebook_connect') }}</a>
                </form>
            </div>
            <div class="medium-4 columns end">
                <h2>@{{ $store.getters.trans('users.register') }}</h2>
                <div class="title">@{{ $store.getters.trans('users.still_not_user') }}</div>
                <div class="texto">@{{ $store.getters.trans('users.create_account_help') }}</div>
                <a href="{{ route('register') }}" class="button expanded">@{{ $store.getters.trans('users.create_account') }}</a>
            </div>
        </div>
    </div>
@endguest
<!-- End Login-->