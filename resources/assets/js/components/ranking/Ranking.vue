<template>
    <div class="page">
        <div class="section">
            <div class="row">
                <div class="medium-12 columns text-left">
                    <div class="title-section">
                        {{ $store.getters.trans('menu.ranking') }}
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
                                <label><span class="uppercase">{{ $store.getters.trans('leagues.leagues') }}</span>
                                    <select name="league" id="league" @change="loadRanking(1)" v-model="league.id" autofocus>
                                        <option value="0">{{ $store.getters.trans('leagues.general_ranking') }}</option>
                                        <option v-for="lg in leagues" :value="lg.id">{{ lg.name }}</option>
                                    </select>
                                </label>
                            </div>
                            <div class="medium-6 columns">
                                <label><span class="uppercase">{{ $store.getters.trans('game.phases') }}</span>
                                    <select name="round" id="round" @change="loadRanking(1)" v-model="round.id">
                                        <option value="0">{{ $store.getters.trans('leagues.accumulated') }}</option>
                                        <option v-for="rnd in rounds" :value="rnd.id">{{ $store.getters.trans('game.round_'+ rnd.name) }}
                                            <!--<small>({{ rnd.start }} - {{ rnd.end }})</small>-->
                                        </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row columns">
                            <h3 class="title">{{ $store.getters.trans('ranking.positions_table') }}</h3>
                            <div class="item-title head">
                                <div class="small-1 columns encabezado text-left">{{ $store.getters.trans('ranking.pos') }}.</div>
                                <div class="small-9 columns encabezado text-left">{{ $store.getters.trans('ranking.participant') }}</div>
                                <div class="small-2 columns encabezado text-right">{{ $store.getters.trans('leagues.points') }}</div>
                            </div>
                            <div class="item" v-for="(user,index ) in users" :class="{'dark':index%2===0}">
                                <div class="small-1 columns posicion text-left">{{ parseInt(index) + 1 }}.</div>
                                <div class="small-9 columns jugador text-left" :class="{'account':userid===user.id}">
                                    {{ user.name + ' ' + (user.last || '') }}
                                </div>
                                <div v-if="round.id===0" class="small-2 columns puntaje text-right">{{ user.points }}</div>
                                <div v-else-if="round.id===1" class="small-2 columns puntaje text-right">{{ user.points_group_phase }}</div>
                                <div v-else-if="round.id===2" class="small-2 columns puntaje text-right">{{ user.points_round_of_16 }}</div>
                                <div v-else-if="round.id===3" class="small-2 columns puntaje text-right">{{ user.points_quarter_finals }}</div>
                                <div v-else-if="round.id===4" class="small-2 columns puntaje text-right">{{ user.points_semi_finals }}</div>
                                <div v-else-if="round.id===5" class="small-2 columns puntaje text-right">{{ user.points_finals }}</div>
                            </div>
                            <ul class="pagination text-center" role="navigation" aria-label="Pagination">
                                <li class="pagination-previous disabled" v-if="!pagination.prev" v-html="$store.getters.trans('pagination.previous')"></li>
                                <li class="pagination-previous" v-else><a @click.prevent="loadRanking(pagination.prev)" aria-label="Prev page" v-html="$store.getters.trans('pagination.previous')"></a></li>
                                <li v-if="pagination.page===1" class="current"><span class="show-for-sr"></span> 1</li>
                                <li v-else><a @click.prevent="loadRanking(1)" aria-label="First Page">1</a></li>
                                <li class="ellipsis" v-if="pagination.page>2"></li>
                                <li v-if="pagination.page !== 1 && pagination.page !== pagination.pages" class="current"><span class="show-for-sr"></span> {{ pagination.page }}</li>
                                <li class="ellipsis" v-if="pagination.pages-pagination.page>1"></li>
                                <li v-if="pagination.pages>2 && pagination.page===pagination.pages" class="current"><span class="show-for-sr"></span> {{ pagination.pages }}</li>
                                <li v-else-if="pagination.pages>2"><a @click.prevent="loadRanking(pagination.pages)" aria-label="Last Page">{{ pagination.pages }}</a></li>
                                <li class="pagination-next disabled" v-if="!pagination.next" v-html="$store.getters.trans('pagination.next')"></li>
                                <li class="pagination-next" v-else><a @click.prevent="loadRanking(pagination.next)" aria-label="Next page" v-html="$store.getters.trans('pagination.next')"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="medium-3 columns text-center banner">
                    <img src="/img/banners/300x600.jpg" alt="Add">
                </div>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
    export default {
      props: ['rounds', 'leagues', 'userid','l','r'],
        mounted() {
            if(this.l) this.league.id = this.l;
            if(this.r) this.round.id = this.r;
            this.loadRanking(1);
        },
        data() {
            return {
                loading:0,
                round: {
                    id: 0,
                    name: this.$store.getters.trans('leagues.accumulated')
                },
                league: {
                    id: 0,
                    name: this.$store.getters.trans('leagues.general_ranking')
                },
                users: [],
                pagination: {
                    page: 1,
                    pages: 1,
                    prev: null,
                    next: null,
                    total: 0,
                    items: 40
                }
            }
        },
        methods: {
            loadRanking(page) {
                this.loading++
                axios.post('/rankingdata/'+page,{'round':this.round.id,'league':this.league.id}).then(
                    ({data}) => {
                        if (data.users) this.users = data.users;
                        if (data.pagination) this.pagination= data.pagination;
                      this.loading--
                    }
                ).catch(function (error) {
                  this.loading--
                }.bind(this));
            },
        }
    }
</script>
