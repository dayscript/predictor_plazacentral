<template>
    <div class="match relative" v-if="match">
        <div class="head">
            {{ match.date }}
            <div class="points">0</div>
        </div>
        <div class="versus">
            <div class="row">
                <div class="small-3 columns text-left">
                    <img v-if="match.local_id.image" :src="'/storage/'+match.local_id.image" :alt="match.local_id.short" class="flag circle thumbnail">
                    <img v-else src="/img/flag-default.png" alt="Default" class="flag">
                </div>
                <div class="small-6 columns text-left">
                    <div class="team" style="line-height: 14px;">{{ $store.getters.trans('teams.'+match.local_id.short) }}</div>
                </div>
                <div class="small-3 columns text-center">
                    <input type="text" placeholder="0" v-model="local_score" @input="updateContent">
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns text-left">
                    <img v-if="match.visit_id.image" :src="'/storage/'+match.visit_id.image" :alt="match.visit_id.short" class="flag circle thumbnail">
                    <img v-else src="/img/flag-default.png" alt="Default" class="flag">
                </div>
                <div class="small-6 columns text-left">
                    <div class="team" style="line-height: 14px;">{{ $store.getters.trans('teams.'+match.visit_id.short) }}</div>
                </div>
                <div class="small-3 columns text-center">
                    <input type="text" placeholder="0" v-model="visit_score" @input="updateContent">
                </div>
            </div>
        </div>
        <div class="social text-center" v-if="local_score && visit_score">
            <social-sharing v-if="match.myprediction && match.myprediction.id" :url="'https://predictor.demodayscript.com/matchpredictions/'+match.myprediction.id" inline-template>
                <div>
                    <network network="facebook">
                        <img src="/img/facebook.png" alt="Facebook" class="pointer">
                    </network>
                    <network network="twitter">
                        <img src="/img/twitter.png" alt="Twitter" class="pointer">
                    </network>
                </div>
            </social-sharing>
        </div>
        <div class="social text-center" v-else>
            <img src="/img/facebook-off.png" alt="Twitter" class="">
            <img src="/img/twitter-off.png" alt="Twitter" class="">
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    props: ['match_id'],
    mounted () {
      if (this.match_id) this.loadMatch()
    },
    data () {
      return {
        loading: 0,
        local_score: null,
        visit_score: null,
        match: null,
      }
    },
    methods: {
      loadMatch () {
        this.loading++
        axios.get('/matches/' + this.match_id).then(
          ({data}) => {
            this.loading--
            if (data.match) this.match = data.match
            if(this.match.myprediction){
              this.local_score = this.match.myprediction.local_score
              this.visit_score = this.match.myprediction.visit_score
            }
          }
        ).catch(function (error) {
          this.loading--
        }.bind(this))
      },
      updateContent: _.debounce(function (e) {
        this.updatePredictions();
      }, 1500),
      updatePredictions () {
        this.loading++;
        axios.post('/matchpredictions/' + this.match.id, {local_score: this.local_score, visit_score: this.visit_score}).then(
          ({data}) => {
            this.loading--;
            this.$emit('updated')
            if (data.message) {
              new PNotify({
                text: data.message,
                type: data.status,
                animation: 'fade',
                delay: 2000
              });
            }
          }
        ).catch(function (error) {
          this.loading--;
          console.log(error);
        });
      },
    }
  }
</script>