<template>
    <div class="container-fluid">
        <div class="row header">

            <HeaderMob
                class="mobile"
            />
            <Header
                class="desctop"
            />
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
    }
}
</script>

<style>
.header {
    z-index: 3;
}

.mobile {
    display: none;
}

@media (max-width: 1024px){
    .mobile {
        display: block !important;
    }

    .desctop {
        display: none !important;
    }
}
</style>
