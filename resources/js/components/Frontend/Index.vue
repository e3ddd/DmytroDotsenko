<template>
    <div class="container-fluid">
        <div class="row header">
            <Header/>
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
import Body from './Body/Body.vue';
import ShareLinks from "./Body/ShareLinks.vue";
export default {
    components: {
        ShareLinks,
        Header,
        Body,
    },

    mounted() {
        this.$store.dispatch('getCategories');
        this.$store.dispatch('setDefaultLanguage');
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
