<template>
    <div class="container-fluid">
        <div class="row header">

            <HeaderMob v-if="this.width <= 981"/>
            <Header v-if="this.width > 981"/>
        </div>
        <div class="row">
            <router-view></router-view>
        </div>
        <div class="row mt-5">

        </div>
    </div>
</template>

<script>
import Header from "./Header/Header.vue";
import HeaderMob from "./Header/HeaderMob.vue";
import Body from './Body/Body.vue';
import ShareLinks from "./Body/ShareLinks.vue";
export default {
    components: {
        ShareLinks,
        HeaderMob,
        Header,
        Body,
    },

    data: () => ({
        width: '',
        trans: {
            home: {
                en: 'Home',
                ua: 'Домівка',
            }
        },
    }),

    mounted() {
        this.$store.dispatch('getCategories');
        this.$store.dispatch('setDefaultLanguage');
        this.width = window.innerWidth;
    }
}
</script>

<style scoped>
img {
    width: 20%;
    height: 70vh;
}

.header {
    z-index: 999999
}
</style>
