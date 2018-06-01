<template>
    <div>
        <div class="section-title">{{ $store.getters.trans('users.change_password') }}</div>
        <label><span class="uppercase">{{ $store.getters.trans('users.new_password') }}</span>
            <input type="password" name="password" id="password" v-model="password" v-on:keyup="resetErrors('password')" :class="{ 'is-invalid-input' : errors.password }">
            <span v-if="errors.password" class="form-error is-visible">{{ errors.password[0] }}</span>
        </label>
        <label><span class="uppercase">{{ $store.getters.trans('users.confirm_password') }}</span>
            <input id="password-confirm" type="password" :class="{ 'is-invalid-input' : errors.password_confirmation }" name="password_confirmation" required v-model="password_confirmation" v-on:keyup="resetErrors('password_confirmation')">
            <span v-if="errors.password_confirmation" class="form-error is-visible">{{ errors.password_confirmation[0]
                }}</span>
        </label>
        <a @click="changePassword" class="button expanded">{{ $store.getters.trans('users.update_password') }}</a>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        loading: 0,
        password: '',
        password_confirmation: '',
        errors: {},
      }
    },
    methods: {
      changePassword () {
        this.loading++
        axios.post('users/updatepassword', {'password': this.password, 'password_confirmation': this.password_confirmation}).then(
          ({data}) => {
            this.loading--
            this.password = this.password_confirmation = '';
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
          this.loading--
          this.password = this.password_confirmation = '';
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
      resetErrors (field) {
        Vue.delete(this.errors, field);
      },
    }
  }
</script>
