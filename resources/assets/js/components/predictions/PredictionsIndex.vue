<template>
    <div class="page">
        <div class="section">
            <div class="row">
                <div class="medium-8 columns text-left">
                    <div class="title-section">
                        {{ $store.getters.trans('menu.my_predictions') }}
                    </div>
                </div>
                <div class="medium-4 columns">
                    <div class="alerta" v-if="updated">
                        {{ $store.getters.trans('predictions.predictions_updated') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="padding-30">
            <div class="row">
                <div class="medium-8 columns">
                    <div class="mensaje" v-if="message" v-html="message"></div>
                </div>
                <div class="medium-4 columns">
                    <div class="acumulado">
                        <div class="row">
                            <div class="small-3 columns">
                                <div class="puntos">0</div>
                            </div>
                            <div class="small-9 columns">
                                <strong>{{ $store.getters.trans('predictions.total_points') }}:</strong>{{ $store.getters.trans('predictions.win_in_these_phase') }}: Lorem ipsum adempte nocte conse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <ul class="tabs" data-active-collapse="false" data-tabs id="collapsing-tabs">
                        <li class="tabs-title is-active">
                            <a href="#panel1c" aria-selected="true">{{ $store.getters.trans('predictions.group_phase') }}</a>
                        </li>
                        <li class="tabs-title">
                            <a href="#panel2c">{{ $store.getters.trans('predictions.elimination_phase') }}</a></li>
                    </ul>
                    <div class="tabs-content" data-tabs-content="collapsing-tabs">
                        <div class="tabs-panel is-active" id="panel1c">
                            <div class="row">
                                <div class="medium-3 columns collapse" v-for="group in groups">
                                    <group-prediction :group="group" @updated="updated=true"></group-prediction>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-panel" id="panel2c">
                            <div class="info">Próximamente</div>
                            <!--<div class="container-teams">-->
                                <!--<div class="fase">-->
                                    <!--<div class="fase-title">Octavos de final</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 21 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="fase">-->
                                    <!--<div class="fase-title">Cuartos de final</div>-->
                                    <!--<div class="col1 cuartos">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points"></div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag-default.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-9 columns text-left">-->
                                                        <!--<div class="team">Equipo 1</div>-->
                                                    <!--</div>-->

                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag-default.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-9 columns text-left">-->
                                                        <!--<div class="team">Equipo 2</div>-->
                                                    <!--</div>-->

                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->

                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1 cuartos">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1 cuartos">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1 cuartos">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="fase">-->
                                    <!--<div class="fase-title">Semifinal</div>-->
                                    <!--<div class="col1 semis">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col1 semis">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->

                                <!--</div>-->
                                <!--<div class="fase">-->
                                    <!--<div class="fase-title">Final</div>-->
                                    <!--<div class="col1 final">-->
                                        <!--<div class="match">-->
                                            <!--<div class="head">-->
                                                <!--junio 20 - 15:00-->
                                                <!--<div class="points">20</div>-->
                                            <!--</div>-->
                                            <!--<div class="versus">-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag1.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Argentina</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                    <!--<div class="small-3 columns text-left">-->
                                                        <!--<img src="assets/img/flag2.png" alt="" class="flag">-->
                                                    <!--</div>-->
                                                    <!--<div class="small-6 columns text-left">-->
                                                        <!--<div class="team">Colombia</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="small-3 columns text-center">-->
                                                        <!--<input type="text" placeholder="0">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <!--<div class="social text-center">-->
                                                <!--<a href="#"><img src="assets/img/facebook.png" alt="Facebook"></a>-->
                                                <!--<a href="#"><img src="assets/img/twitter.png" alt="Twitter"></a>-->
                                                <!--<a href="#"><img src="assets/img/email.png" alt="Email"></a>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->

                                <!--</div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center margin-30">
                <img src="/img/ads/728x90.png" alt="">
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['message', 'groups'],
    data () {
      return {
        updated: false
      }
    },
    mounted () {
      console.log('Component mounted.')
    }
  }
</script>
