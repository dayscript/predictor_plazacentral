<div class="footer">
    <div class="row">
        <div class="medium-4 columns">
            <div class="img-logo">
                <img class="logo" src="/img/logo_plaza_central.png" alt="Plaza Central">
            </div>
        </div>
        <div class="medium-2 columns">
            <div class="img-logo">
                <img class="logo" src="/img/logo_familia_tricolor.png" alt="Familia Tricolor">
            </div>
        </div>
        <div class="medium-6 columns">
            <ul>
                <li>@{{ $store.getters.trans('footer.copyright') }} &copy; {{ date('Y') }} {{ config('app.name', 'Predictor') }} </li>
                <li><a href="terms-and-conditions">@{{ $store.getters.trans('footer.terms_and_conditions') }}</a></li>
                <li><a href="privacy-policy">@{{ $store.getters.trans('footer.privacy_policy') }}</a></li>
                <li><a href="support">@{{ $store.getters.trans('footer.support') }}</a></li>
            </ul>
        </div>
    </div>
</div>