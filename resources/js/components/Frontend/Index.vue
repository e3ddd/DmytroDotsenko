<template>
    <div class="container-fluid">
        <div class="row">
            <Header/>
        </div>
        <div class="row"></div>
        <div class="row">

        </div>
    </div>
</template>

<script>
import Header from "./Header/Header.vue";
export default {
    components: {
        Header,
    },

    mounted() {
        this.$store.dispatch('getCategories');
    }
}
</script>

<style scoped>
img {
    width: 20%;
    height: 70vh;
}

</style>
