<template>
    <div>
        <div class="row">
            <div class="medium-6 columns">
                <label>Ligas
                    <select name="league" id="league" @change="loadSummary" v-model="league.id" autofocus>
                        <option value="0">Clasificación General</option>
                        <option v-for="lg in leagues" :value="lg.id">{{ lg.name }}</option>
                    </select>
                </label>
            </div>
            <div class="medium-6 columns">
                <label>Fechas
                    <select name="round" id="round" @change="loadSummary" v-model="round.id">
                        <option value="0">Seleccione</option>
                        <option v-for="rnd in rounds" :value="rnd.id">{{ rnd.name }}
                            <small>({{ rnd.start }} - {{ rnd.end }})</small>
                        </option>
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <div class="row columns resumen text-center">
                    <div class="medium-4 medium-offset-1 columns status">Posición en esta liga: <strong>{{ position }}</strong></div>
                    <div class="medium-4 columns status"> Puntaje acumulado: <strong>{{ userpoints}}</strong></div>
                    <div class="medium-2 columns end"><a href="#" class="button small expanded">Ver Detalle</a></div>
                </div>
                <div class="row columns encabezado hide-for-small-only">
                    <div class="medium-2 columns text-left">Fecha</div>
                    <div class="medium-8 columns text-center">Encuentro</div>
                    <div class="medium-2 columns text-center">Puntos</div>
                </div>
                <div class="row item column gutter-small partido" v-for="match in matches">
                    <div class="medium-2 columns fecha text-left"> {{ match.when }}</div>
                    <div class="small-6 medium-4 columns text-right">
                        {{ match.local_id.name }}
                        <!--<img :src="'/storage/'+match.local_id.small_image" :alt="match.local_id.name">-->
                        <strong>{{ match.local_score }}</strong>
                    </div>
                    <div class="small-6 medium-4 columns left">
                        <strong>{{ match.visit_score }}</strong>
                       <!-- <img :src="'/storage/'+match.visit_id.small_image" :alt="match.visit_id.name">-->
                        {{ match.visit_id.name }}
                    </div>
                    <div class="medium-2 columns text-center puntaje"><strong class="show-for-small-only">Puntos: </strong>{{ match.points }}</div>
                </div>
                <hr>
                <div class="row columns gutter-small">
                    <div class="text-center suma"> Puntaje total de fecha: <strong>{{ totalPoints }} Puntos</strong></div>
                </div>
                <hr>
                <hr class="light">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.loadSummary();
        },
        data() {
            return {
                round: {
                    id: 0,
                    name: 'Seleccione'
                },
                league: {
                    id: 0,
                    name: 'Clasificación General'
                },
                matches:[],
                position:'',
            }
        },
        props: ['rounds','leagues','userid','userpoints'],
        methods: {
            loadSummary(){
                if(this.round.id){
                    $('#loadingModal').foundation('open');
                    axios.post('/roundmatches/' + this.round.id,{'league_id':this.league.id,'user_id':this.userid}).then(
                        ({data}) => {
                            if (data.matches) this.matches = data.matches;
                            if(data.position)this.position = data.position;
                            $('#loadingModal').foundation('close');
                            if(data.message){
                                new PNotify({
                                    text: data.message,
                                    type: data.status,
                                    animation: 'fade',
                                    delay: 2000
                                });
                            }
                        }
                    ).catch(function (error) {
                        $('#loadingModal').foundation('close');
                    });
                }

            }
        },computed:{
            totalPoints(){
                var total = 0;
                this.matches.forEach(function(val){
                    total += val.points;
                });
                return total;
            }
        }
    }
</script>
