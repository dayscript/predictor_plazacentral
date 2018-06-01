@extends('layouts.app')

@section('title')
    {{ __('menu.ranking') }} @parent
@endsection

@section('content')
<div class="page">
    <div class="section">
        <div class="row">
            <div class="medium-12 columns text-left">
                <div class="title-section">
                    @{{ $store.getters.trans('menu.ranking') }}
                </div>
            </div>
        </div>
    </div>
    <div class="padding-30">
        <div class="row">
            <div class="medium-9 columns">
                <div class="info">
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Ligas
                                <select>
                                    <option value="">Seleccione</option>
                                </select>
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Fases
                                <select>
                                    <option value="">Seleccione</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="row columns">
                        <h3 class="title">Tabla de posiciones</h3>
                        <div class="item-title head">
                            <div class="small-1 columns encabezado text-left">
                                Pos.
                            </div>
                            <div class="small-9 columns encabezado text-left">
                                Participante
                            </div>
                            <div class="small-2 columns encabezado text-right">
                                Puntos
                            </div>
                        </div>
                        <div class="item dark">
                            <div class="small-1 columns posicion text-left">
                                1.
                            </div>
                            <div class="small-9 columns jugador text-left">
                                Julian Andres Cardenas
                            </div>
                            <div class="small-2 columns puntaje text-right">
                                120
                            </div>
                        </div>
                        <div class="item">
                            <div class="small-1 columns posicion text-left">
                                2.
                            </div>
                            <div class="small-9 columns jugador text-left">
                                Carlos David Ortega
                            </div>
                            <div class="small-2 columns puntaje text-right">
                                90
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="medium-3 columns text-center banner">
                @include('ads.vertical')
            </div>
        </div>
    </div>
</div>
@endsection