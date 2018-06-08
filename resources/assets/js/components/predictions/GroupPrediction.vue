<template>
    <div class="match relative">
        <div class="head">
            {{ $store.getters.trans('predictions.group_'+group.name) }}
            <div class="points">0</div>
        </div>
        <div class="positions">
            <div class="row">
                <div class="small-3 small-offset-3 columns text-center">
                    <div class="team">{{ $store.getters.trans('predictions.1st') }}</div>
                    <draggable v-model="first" :options="{group:{name:'teams',pull:true,put:['teams','teams0','teams1','teams2','teams3']}}" @start="teamSelected" @end="teamSelected" @change="teamSelected">
                        <transition-group mode="out-in" class="round-box" tag="div" name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated fadeOutDown">
                            <img :src="'/storage/'+team.image" :alt="team.short" class="flag circle thumbnail" v-for="team in first" :key="team.id">
                        </transition-group>
                    </draggable>
                    <div class="team" v-if="first.length">{{ $store.getters.trans('teams.'+first[0].short + '_short') }}</div>
                    <div class="team" v-else>-</div>
                </div>
                <div class="small-3 columns end text-center">
                    <div class="team">{{ $store.getters.trans('predictions.2nd') }}</div>
                    <draggable v-model="second" :options="{group:{name:'teams',pull:true,put:['teams','teams0','teams1','teams2','teams3']}}" @start="teamSelected" @end="teamSelected" @change="teamSelected">
                        <transition-group mode="out-in" class="round-box" tag="div" name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated fadeOutDown">
                            <img :src="'/storage/'+team.image" :alt="team.short" class="flag circle thumbnail" v-for="team in second" :key="team.id">
                        </transition-group>
                    </draggable>
                    <div class="team" v-if="second.length">{{ $store.getters.trans('teams.'+second[0].short + '_short') }}</div>
                    <div class="team" v-else>-</div>
                </div>
            </div>
        </div>
        <div class="teams">
            <div class="row">
                <div class="small-3 columns text-center" v-for="(list,index) in teams">
                    <draggable v-model="teams[index]" :options="{group:{name:'teams'+index,pull:true,put:false}}" @start="teamSelected" @end="teamSelected" @change="teamSelected">
                        <img :src="'/storage/'+tm.image" :alt="tm.short" class="flag circle thumbnail hoverable" v-for="tm in list" :key="tm.id">
                        <img src="/img/flag-empty.png" alt="Empty" class="flag circle" v-if="list.length===0" key="empty">
                    </draggable>
                    <div class="team" v-if="list.length">{{ $store.getters.trans('teams.'+list[0].short + '_short') }}</div>
                </div>
            </div>
        </div>
        <div class="social text-center" v-if="first.length && second.length">
            <social-sharing v-if="group.myprediction && group.myprediction.id" :url="'https://predictor.demodayscript.com/predictions/'+group.myprediction.id" inline-template>
                <div>
                    <network network="facebook">
                        <img src="/img/facebook.png" alt="Facebook" class="pointer">
                    </network>
                    <!--<network network="googleplus">-->
                        <!--<i class="fa fa-fw fa-google-plus"></i> Google +-->
                    <!--</network>-->
                    <!--<network network="linkedin">-->
                        <!--<i class="fa fa-fw fa-linkedin"></i> LinkedIn-->
                    <!--</network>-->
                    <!--<network network="pinterest">-->
                        <!--<i class="fa fa-fw fa-pinterest"></i> Pinterest-->
                    <!--</network>-->
                    <!--<network network="reddit">-->
                        <!--<i class="fa fa-fw fa-reddit"></i> Reddit-->
                    <!--</network>-->
                    <network network="twitter">
                        <img src="/img/twitter.png" alt="Twitter" class="pointer">
                    </network>
                    <!--<network network="vk">-->
                        <!--<i class="fa fa-vk"></i> VKontakte-->
                    <!--</network>-->
                    <!--<network network="weibo">-->
                        <!--<i class="fa fa-weibo"></i> Weibo-->
                    <!--</network>-->
                    <!--<network network="whatsapp">-->
                        <!--<i class="fa fa-fw fa-whatsapp"></i> Whatsapp-->
                    <!--</network>-->
                </div>
            </social-sharing>
            <!--<a href="#"><img src="/img/email.png" alt="Email"></a>-->
        </div>
        <div class="social text-center" v-else>
            <img src="/img/facebook-off.png" alt="Twitter" class="">
            <img src="/img/twitter-off.png" alt="Twitter" class="">
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import draggable from 'vuedraggable'
  export default {
    components: {draggable},
    props: ['group'],
    data () {
      return {
        loading: 0,
        first: [],
        second: [],
        teams: {
          '0': [],
          '1': [],
          '2': [],
          '3': [],
        }
      }
    },
    mounted () {
      this.loading++
      if (this.group.teams) {
        this.group.teams.forEach(function (item, index) {
          if(this.group.myprediction.first_team_id && this.group.myprediction.first_team_id === item.id) {
            this.first.push(item)
          }else if(this.group.myprediction.second_team_id && this.group.myprediction.second_team_id === item.id){
            this.second.push(item)
          } else {
            this.teams[index].push(item);
          }
        }.bind(this));
      }
      
      this.loading--
    },
    methods: {
      teamSelected (event) {
        if (event.added) {
          if ((this.first.length > 1) && (event.added.newIndex === 0)) {
            let temp = this.first.pop()
            this.teams[temp.pivot.order - 1].push(temp)
          } else if ((this.first.length > 1) && (event.added.newIndex === 1)) {
            let temp = this.first.shift()
            this.teams[temp.pivot.order - 1].push(temp)
          }
          if ((this.second.length > 1) && (event.added.newIndex === 0)) {
            let temp = this.second.pop()
            this.teams[temp.pivot.order - 1].push(temp)
          } else if ((this.second.length > 1) && (event.added.newIndex === 1)) {
            let temp = this.second.shift()
            this.teams[temp.pivot.order - 1].push(temp)
          }
        }
        if (event.moved || event.added) {
          this.updatePredictions()
        }
      },
      updatePredictions() {
        this.loading++;
        axios.post('/predictions/' + this.group.id, {first: this.first.length?this.first[0].id:null, second: this.second.length?this.second[0].id:null}).then(
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
<style lang="scss">
    .round-box {
        border-radius: 50%;
        position: relative;
        width: 100%;
        border: 1px dashed #ccc;
        img {
            top: 0;
            position: absolute;
            left: 0;
        }
    }

    .round-box:before {
        content: "";
        display: block;
        padding-top: 100%;
    }

    .list-complete-item {
        transition: all 1s;
    }

    .list-complete-enter, .list-complete-leave-active {
        opacity: 0;
    }
</style>