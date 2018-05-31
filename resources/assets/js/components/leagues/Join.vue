<template>
    <div class="row margin-60">
        <div class="medium-6 columns">
            <p v-html="$store.getters.trans('leagues.join_intro')"></p>
        </div>
        <div class="medium-6 columns">
            <label><span class="uppercase">{{ $store.getters.trans('leagues.invitation_code')}}:</span>
                <input v-model="code" type="text" name="code" id="code" autofocus :placeholder="$store.getters.trans('leagues.join_code_placeholder')">
            </label>
            <a @click="joinLeague" class="button expanded">{{ $store.getters.trans('leagues.join')}}</a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.initialcode) this.code = this.initialcode;
        },
        props: ['initialcode'],
        data() {
            return {
                code: null
            }
        },
        methods: {
            joinLeague() {
                if (this.code) {
                    $('#loadingModal').foundation('open');
                    axios.post('/leagues/join', {code: this.code}).then(
                        ({data}) => {
                            $('#loadingModal').foundation('close');
                            if (data.message) {
                                new PNotify({
                                    text: data.message,
                                    type: data.status,
                                    animation: 'fade',
                                    delay: 2000
                                });
                            }
                            if (data.status === 'success')
                                document.location.href = '/leagues';
                        }
                    ).catch(function (error) {
                        $('#loadingModal').foundation('close');
                    });
                }
            }
        }
    }
</script>
