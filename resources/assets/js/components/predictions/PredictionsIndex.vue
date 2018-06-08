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
                    <div class="mensaje" v-html="$store.getters.trans('predictions.predictions_help_message')"></div>
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
                            <div class="container-teams">
                                <div class="fase">
                                    <div class="fase-title">{{ $store.getters.trans('game.round_round_of_16') }}</div>
                                    <div class="col1">
                                        <match-prediction :match_id="958070"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958071"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958075"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958074"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958072"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958073"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958077"></match-prediction>
                                    </div>
                                    <div class="col1">
                                        <match-prediction :match_id="958076"></match-prediction>
                                    </div>
                                </div>
                                <div class="fase">
                                    <div class="fase-title">{{ $store.getters.trans('game.round_quarter_finals') }}</div>
                                    <div class="col1 cuartos">
                                        <match-prediction :match_id="958078"></match-prediction>
                                    </div>
                                    <div class="col1 cuartos">
                                        <match-prediction :match_id="958079"></match-prediction>
                                    </div>
                                    <div class="col1 cuartos">
                                        <match-prediction :match_id="958080"></match-prediction>
                                    </div>
                                    <div class="col1 cuartos">
                                        <match-prediction :match_id="958081"></match-prediction>
                                    </div>
                                </div>
                                <div class="fase">
                                    <div class="fase-title">{{ $store.getters.trans('game.round_semi_finals') }}</div>
                                    <div class="col1 semis">
                                        <match-prediction :match_id="958082"></match-prediction>
                                    </div>
                                    <div class="col1 semis">
                                        <match-prediction :match_id="958083"></match-prediction>
                                    </div>
                                </div>
                                <div class="fase">
                                    <div class="fase-title">{{ $store.getters.trans('game.round_finals') }}</div>
                                    <div class="col1 final">
                                        <match-prediction :match_id="958085"></match-prediction>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center margin-30">
                <img src="/img/banners/MPI_320x50_Q20089_GM_99Coverage_ST.jpg" alt="" class="Add">
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['groups'],
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
