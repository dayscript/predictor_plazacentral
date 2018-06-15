<div class="orbit" role="region" aria-label=" " data-orbit>
    <div class="orbit-wrapper">
        <ul class="orbit-container">
            <li class="is-active orbit-slide">
                <div class="row">
                    <div class="medium-6 columns">
                        <div class="container-slide">
                            <!--<div class="seccion hide-for-small-only">@{{ $store.getters.trans('menu.prizes') }}</div>-->
                            <!--<h1>Lorem ipsum dolor amera consectetur adipiscing </h1>-->
                           <!--<a href="#" class="button hide-for-small-only">@{{ $store.getters.trans('menu.play') }}</a>-->
                        </div>
                    </div>
                </div>

                <figure class="orbit-figure">
                    <img class="orbit-image" :src="'/img/slide/' + $store.state.lang + '/premios.png'" alt="Predictor">
                </figure>
            </li>
            <li class="orbit-slide">
                <div class="row">
                    <div class="medium-6 columns">
                        <div class="container-slide">

                        </div>
                    </div>
                </div>

                <figure class="orbit-figure">
                    <img class="orbit-image" :src="'/img/slide/' + $store.state.lang + '/1.jpg'" alt="Predictor">
                </figure>
            </li>
        </ul>
    </div>
    <nav class="orbit-bullets">
        <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span
                    class="show-for-sr">Current Slide</span></button>
        <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
    </nav>
</div>