<template>
    <div>
        <div class="row margin-60">
            <div class="medium-12 columns">
                <h5 class="title">1. {{ $store.getters.trans('leagues.league_data') }}</h5>
                <p v-html="$store.getters.trans('leagues.create_intro')"></p>
            </div>
            <div class="medium-6 columns">
                <label><span class="uppercase">{{ $store.getters.trans('leagues.league_name') }}:</span>
                    <input type="text" v-model="name" name="name" id="name" autofocus v-on:keyup="resetErrors('name')"
                           :class="{ 'is-invalid-input' : errors.name }">
                    <span v-if="errors.name" class="form-error is-visible">{{ errors.name[0] }}</span>
                </label>
            </div>
            <div class="medium-6 columns">
                <label><span class="uppercase">{{ $store.getters.trans('leagues.create_code') }}:</span>
                    <input type="text" name="code" id="code" v-model="code" v-on:keyup="resetErrors('code')"
                           :class="{ 'is-invalid-input' : errors.code }"
                           :placeholder="$store.getters.trans('leagues.create_code_placeholder')">
                    <span v-if="errors.code" class="form-error is-visible">{{ errors.code[0] }}</span>
                </label>
            </div>
            <div class="medium-12 columns">
                <label><span class="uppercase">{{ $store.getters.trans('leagues.league_description') }}:</span>
                    <input type="text" v-model="description" name="description" id="description"
                           v-on:keyup="resetErrors('description')" :class="{ 'is-invalid-input' : errors.description }">
                    <span v-if="errors.description" class="form-error is-visible">{{ errors.description[0] }}</span>
                </label>
            </div>
            <div class="medium-6 columns">
                <a v-if="id" class="button expanded" @click="updateLeague">{{ $store.getters.trans('leagues.update_league') }}</a>
                <a v-else class="button expanded" @click="createLeague">{{ $store.getters.trans('leagues.create_league') }}</a>
            </div>
            <div class="medium-6 columns">
                <a v-if="id" class="button alert expanded" @click="deleteLeague">{{ $store.getters.trans('leagues.delete_league') }}</a>
            </div>
        </div>
        <div v-if="id">
            <league-invite :id="id"></league-invite>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    mounted () {
      if (this.league) {
        this.id = this.league.id;
        this.name = this.league.name;
        this.description = this.league.description;
        this.code = this.league.code;
      }
    },
    props: ['league'],
    data () {
      return {
        loading: 0,
        id: null,
        name: '',
        description: '',
        code: '',
        errors: {}
      }
    },
    methods: {
      updateLeague () {
        this.loading++
        axios.put('/leagues/' + this.id, {name: this.name, description: this.description, code: this.code}).then(
          ({data}) => {
            if (data.message) {
              new PNotify({
                text: data.message,
                type: data.status,
                animation: 'fade',
                delay: 2000
              });
            }
            this.loading--
          }
        ).catch(function (error) {
          this.loading--
          if (error.response) {
            if (error.response.status === 422) {
              var data = error.response.data;
              this.errors = data.errors;
            } else if (error.response.status === 403) {
              new PNotify({
                text: this.$store.getters.trans('leagues.not_authorized'),
                type: 'error',
                animation: 'fade',
                delay: 2000
              });
            } else {
              console.log(error.response.status);
            }
          } else {
            console.log('Error', error.message);
          }
        });
      },
      createLeague () {
        this.loading++
        axios.post('/leagues', {name: this.name, description: this.description, code: this.code}).then(
          ({data}) => {
            if (data.id) this.id = data.id;
            if (data.message) {
              new PNotify({
                text: data.message,
                type: data.status,
                animation: 'fade',
                delay: 2000
              });
            }
            this.loading--
          }
        ).catch(function (error) {
          this.loading--
          if (error.response) {
            if (error.response.status === 422) {
              var data = error.response.data;
              this.errors = data.errors;
            } else {
              console.log(error.response.status);
            }
          } else {
            console.log('Error', error.message);
          }
        }.bind(this));
      },
      deleteLeague () {
        if (confirm(this.$store.getters.trans('leagues.are_you_sure_delete'))) {
          this.loading++
          axios.delete('/leagues/' + this.id).then(
            ({data}) => {
              if (data.message) {
                if (data.status === 'success') {
                  this.id = null;
                  this.name = '';
                  this.description = '';
                  this.code = '';
                }
                new PNotify({
                  text: data.message,
                  type: data.status,
                  animation: 'fade',
                  delay: 2000
                });
              }
              this.loading--
            }
          ).catch(function (error) {
            this.loading--
            if (error.response) {
              if (error.response.status === 403) {
                new PNotify({
                  text: this.$store.getters.trans('leagues.not_authorized'),
                  type: 'error',
                  animation: 'fade',
                  delay: 2000
                });
              } else {
                console.log(error.response.status);
              }
            } else {
              console.log('Error', error.message);
            }
          });
        }
      },
      resetErrors (field) {
        Vue.delete(this.errors, field);
      },
    }
  }
</script>
