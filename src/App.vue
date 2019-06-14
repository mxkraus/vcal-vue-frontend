<template>
    <div id="app">
        <vue-ads-layout
            :full-bar="true"
        >
            <vue-ads-bar
                slot="toolbar"
                :fixed="true"
                class="ads-bar"
            >
                <header class="ads-title" slot="first">Vereinskalender</header>
                <vue-ads-hide-button
                    slot="last"
                    :hidden="hiddenRight"
                    @clicked="hideRight"
                    class="ads-hamburger"
                />

            </vue-ads-bar>

            <vue-ads-drawer
                slot="right-drawer"
                :fixed="true"
                :minified="minifiedRight"
                :hidden="hiddenRight"
                :right="true"
                class="ads-drawer"
                @minify="minifyRight"
                @hide="hideRight"
            >

                <b-nav vertical class="w-25">
                    <b-nav-item class="nav-item" active to="/" >Home</b-nav-item>
                    <b-nav-item class="nav-item" to="/event-list">Events</b-nav-item>
                </b-nav>

            </vue-ads-drawer>

 
            <router-view></router-view>

 
        </vue-ads-layout>
    </div>
</template>


<script>

import '../node_modules/@fortawesome/fontawesome-free/css/all.css';
import '../node_modules/vue-ads-layout/dist/vue-ads-layout.css';

import { VueAdsLayout, VueAdsBar, VueAdsDrawer, VueAdsHideButton } from 'vue-ads-layout';


export default {
    name: 'App',

    components: {
        VueAdsHideButton,
        VueAdsDrawer,
        VueAdsBar,
        VueAdsLayout,

    },

    data () {
        return {
            minifiedLeft: null,
            minifiedRight: null,
            hiddenLeft: null,
            hiddenRight: true,
        };
    },

    methods: {
        minifyLeft (minified) {
            this.minifiedLeft = minified;
        },

        hideLeft (hidden) {
            this.hiddenLeft = hidden;
        },

        minifyRight (minified) {
            this.minifiedRight = minified;
        },

        hideRight (hidden) {
            this.hiddenRight = hidden;
        },
    },
};
</script>

<style lang="scss">

    // @import 'assets/sass/bootstrap.min.css';
    @import 'assets/sass/variables.scss';
    @import 'assets/sass/reset.scss';
    @import 'assets/sass/layout.scss';
    @import 'assets/sass/app.scss';

</style>