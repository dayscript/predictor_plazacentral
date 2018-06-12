<template>
    <div class="row">
        <div class="medium-6 columns">
            <label>{{ $store.getters.trans('contact.name') }}
                <input type="text" v-model="name" name="name" id="name" autofocus required v-on:keyup="resetErrors('name')" :class="{ 'is-invalid-input' : errors.name }">
                <span v-if="errors.name" class="form-error is-visible">{{ errors.name[0] }}</span>
            </label>
            <label>{{ $store.getters.trans('contact.email') }}
                <input type="email" name="email" id="email" v-model="email" v-on:keyup="resetErrors('email')" :class="{ 'is-invalid-input' : errors.email }">
                <span v-if="errors.email" class="form-error is-visible">{{ errors.email[0] }}</span>
            </label>
            <label>{{ $store.getters.trans('contact.country') }}
                <input type="text" name="country" id="country" v-model="country" v-on:keyup="resetErrors('country')" :class="{ 'is-invalid-input' : errors.country }">
                <span v-if="errors.country" class="form-error is-visible">{{ errors.country[0] }}</span>
            </label>
        </div>
        <div class="medium-6 columns">
            <label>{{ $store.getters.trans('contact.last_name') }}
                <input type="text" v-model="last" name="last" id="last" v-on:keyup="resetErrors('last')" :class="{ 'is-invalid-input' : errors.last }">
                <span v-if="errors.last" class="form-error is-visible">{{ errors.last[0] }}</span>
            </label>
            <label>{{ $store.getters.trans('contact.phone') }}
                <input type="text" v-model="phone" name="phone" id="phone" v-on:keyup="resetErrors('phone')" :class="{ 'is-invalid-input' : errors.phone }">
                <span v-if="errors.phone" class="form-error is-visible">{{ errors.phone[0] }}</span>
            </label>
            <label>{{ $store.getters.trans('contact.city') }}
                <input type="text" v-model="city" name="city" id="city" v-on:keyup="resetErrors('city')" :class="{ 'is-invalid-input' : errors.city }">
                <span v-if="errors.city" class="form-error is-visible">{{ errors.city[0] }}</span>
            </label>
        </div>
        <div class="medium-12 columns">
            <label>{{ $store.getters.trans('contact.message') }}:
                <textarea v-model="message" name="message" rows="4" id="message" v-on:keyup="resetErrors('message')" :class="{ 'is-invalid-input' : errors.message }"></textarea>
                <span v-if="errors.message" class="form-error is-visible">{{ errors.message[0] }}</span>
            </label>
        </div>
        <div class="medium-4 medium-offset-4 columns end">
            <div class="text-center">
                <a @click="sendContact" class="button expanded">{{ $store.getters.trans('contact.send') }}</a>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        name: '',
        last: '',
        email: '',
        country: '',
        city: '',
        phone: '',
        message: '',
        errors: {},
        loading: 0
      }
    },
    methods: {
      sendContact () {
        this.loading++
        axios.post('/contact', {
          name: this.name,
          last: this.last,
          country: this.country,
          city: this.city,
          phone: this.phone,
          email: this.email,
          message: this.message,
        }).then(
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
