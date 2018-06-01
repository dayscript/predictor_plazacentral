<template>
    <div class="item" :class="rowclass">
        <div class="medium-6 columns liga-info text-left"><a :href="'/ranking?l='+league.id">{{ league.name }}</a></div>
        <div class="medium-2 columns liga-info text-center">
            <strong class="show-for-small-only">{{ $store.getters.trans('leagues.users') }}:</strong> {{ league.users_count }}
        </div>
        <div class="medium-2 columns liga-info text-center">
            <strong class="show-for-small-only">{{ $store.getters.trans('leagues.points') }}: </strong>{{ league.users_points }}
        </div>
        <div class="medium-2 columns liga-info text-center">
            <a v-if="editable" :href="'/leagues/'+league.id+'/edit'" class="button small">{{ $store.getters.trans('leagues.edit') }}</a>
            <a v-if="!editable" @click="leaveLeague" class="button alert small">{{ $store.getters.trans('leagues.leave') }}</a>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    props: ['league', 'editable', 'rowclass'],
    data () {
      return {
        loading: 0,
      }
    },
    methods: {
      leaveLeague () {
        this.loading++
        axios.post('/leagues/' + this.league.id + '/leave').then(
          ({data}) => {
            this.loading--
            if (data.message) {
              new PNotify({
                text: data.message,
                type: data.status,
                animation: 'fade',
                delay: 2000
              });
            }
            document.location.href = '/leagues';
          }
        ).catch(function (error) {
          this.loading--
        });
      }
    }
  }
</script>
