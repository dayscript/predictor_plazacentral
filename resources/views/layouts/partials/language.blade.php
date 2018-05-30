<div class="top-nav">
    <div class="row">
        <div class="medium-2 medium-offset-10 columns">
            <ul class="lang">
                <li><a @click.prevent="$store.commit('spanish')" :class="{'active':$store.state.lang=='es'}" href="#">Español</a></li>
                <li><a @click.prevent="$store.commit('english')" :class="{'active':$store.state.lang=='en'}" href="#">English</a></li>
            </ul>
        </div>
    </div>
</div>