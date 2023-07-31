<template>
    <div class="container-fluid">
        <div class="row" v-for="painting in $store.getters.getAllPaintings">
            <div class="col p-0 paintings">
                <router-link :to="'/' + painting.slug">
                    <div class="row image">
                        <img :src="'/storage/images/' + painting.images[0].painting_id + '_' + painting.images[0].hash_id" alt="">
                    </div>
                </router-link>
                <div class="row">
                    <div class="col name">
                        <h1>{{painting['name_' + $store.getters.getLanguage] }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col parameters">
                        <h3>{{painting['style_' + $store.getters.getLanguage]}}, {{painting['material_' + $store.getters.getLanguage]}}, {{painting.height}}x{{painting.long}}cm</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col year">
                        <h3>{{painting.year}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () =>({
        width: '',
    }),

    mounted() {
        this.$store.dispatch('getAllPaintings');
        this.width = window.innerWidth;
    }
}
</script>

<style scoped>
.image img {
    padding: 0;
}

.paintings {
    opacity: 0;
    animation: ani 1s forwards;
    margin-bottom: 150px !important;
}

.name {
    padding: 30px 0px 0px 50px;
}

.parameters {
    margin-top: 30px;
}

.parameters, .year{
    padding: 10px 0px 0px 50px;
}

@keyframes ani {
    0% {opacity: 0;}
    100% {opacity: 1;}
}

</style>
