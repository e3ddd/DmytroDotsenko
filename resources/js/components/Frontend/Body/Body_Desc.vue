<template>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col paintings" v-for="painting in $store.getters.getAllPaintings">
                <div class="row">
                    <router-link :to="'/' + painting.slug">
                        <div class="row image">
                            <img :src="'/storage/images/' + painting.images[0].painting_id + '_' + painting.images[0].hash_id" alt="">
                        </div>
                    </router-link>
                </div>
                <div class="row pt-3">
                    <div class="col name">
                        <h5>{{painting['name_' + $store.getters.getLanguage] }}</h5>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col parameters">
                        <h6>{{painting['style_' + $store.getters.getLanguage]}}, {{painting['material_' + $store.getters.getLanguage]}}, {{painting.height}}x{{painting.long}}cm</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col year">
                        <h6>{{painting.year}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.paintings {

}
</style>
