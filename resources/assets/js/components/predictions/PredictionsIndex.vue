<template>
    <div>
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
                                <div class="puntos">{{ points }}</div>
                            </div>
                            <div class="small-9 columns">
                                <strong>{{ $store.getters.trans('predictions.total_points') }}:</strong>{{ $store.getters.trans('predictions.win_in_these_phase') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <ul class="tabs" data-active-collapse="false" data-tabs id="collapsing-tabs">
                        <li class="tabs-title">
                            <a href="#panel1c">{{ $store.getters.trans('predictions.group_phase') }}</a>
                        </li>
                        <li class="tabs-title">
                            <a href="#panel2c" aria-selected="true">{{ $store.getters.trans('game.round_round_of_16') }}</a></li>
                        <li class="tabs-title">
                            <a href="#panel3c">{{ $store.getters.trans('game.round_quarter_finals') }}</a></li>
                        <li class="tabs-title">
                            <a href="#panel4c">{{ $store.getters.trans('game.round_semi_finals') }}</a></li>
                        <li class="tabs-title is-active"><a href="#panel5c">{{ $store.getters.trans('game.round_finals') }}</a>
                        </li>
                    </ul>
                    <div class="tabs-content" data-tabs-content="collapsing-tabs">
                        <div class="tabs-panel" id="panel1c">
                            <div class="row">
                                <div class="medium-3 columns collapse" v-for="group in groups">
                                    <group-prediction :group="group" :active="active=='groups'" @updated="onUpdated"></group-prediction>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-panel" id="panel2c">
                            <div class="row">
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958070"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958071"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958075"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958074"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958072"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958073"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958077"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958076"></match-prediction>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-panel" id="panel3c">
                            <div class="row">
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958078"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958079"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958080"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958081"></match-prediction>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-panel" id="panel4c">
                            <div class="row">
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958082"></match-prediction>
                                </div>
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958083"></match-prediction>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-panel is-active" id="panel5c">
                            <div class="row">
                                <div class="medium-3 columns collapse end">
                                    <match-prediction :match_id="958085"></match-prediction>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['groups', 'total','active'],
    data () {
      return {
        points: 0,
        updated: false
      }
    },
    mounted () {
      this.points = this.total
    },
    methods: {
      onUpdated(points) {
        this.points = points
        this.updated = true
      }
    }
  }
</script>
