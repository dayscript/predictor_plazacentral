<template>
    <div class="row">
        <div class="medium-12 columns">
            <h5 class="title">2. {{ $store.getters.trans('leagues.invite_your_friends') }}</h5>
        </div>
        <div class="medium-6 columns">
            <p v-html="$store.getters.trans('leagues.invite_friends_intro')"></p>
            <textarea placeholder="Tu lista de amigos" name="list" id="list" v-model="list"></textarea>
            <a @click="sendInvites" class="button expanded">{{ $store.getters.trans('leagues.invite') }}</a>
        </div>
        <div class="medium-6 columns"><p></p></div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
        loading: 0,
        list: ''
      }
    },
    methods: {
      sendInvites () {
        this.loading++
        axios.post('/leagues/' + this.id + '/invite', {list: this.list}).then(
          ({data}) => {
            if (data.message) {
              new PNotify({
                text: data.message,
                type: data.status,
                animation: 'fade',
                delay: 2000
              });
              this.list = '';
            }
            this.loading--
          }
        ).catch(function (error) {
          this.loading--
        });
      },
    }
  }
</script>
