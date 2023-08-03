<template>
    <BuyModal v-if="this.show"
        @show="showModal"
    />
    <div class="container-fluid mobile p-4">
    <div class="row">
        <div class="col carousel">
            <Carousel>
                <Slide v-for="image in $store.getters.getCurrentPainting.images"
                       :key="image.id">
                        <background-image
                            :path="'/storage/images/' + image.painting_id + '_' + image.hash_id"
                        />
                </Slide>
                <template #addons>
                    <Navigation />
                    <Pagination />
                </template>
            </Carousel>
        </div>
    </div>
        <div class="row">
            <div class="col mt-5">
                <h1>{{ $store.getters.getCurrentPainting['name_' + $store.getters.getLanguage] }}</h1>
            </div>
        </div>
        <div class="row mt-5 mb-5 price" v-if="$store.getters.getCurrentPainting.price !== null">
            {{ $store.getters.getCurrentPainting.price }} y.o.
        </div>

        <div class="row description">
            <div class="col">
                {{ $store.getters.getCurrentPainting['description_' + $store.getters.getLanguage] }}
            </div>
        </div>
        <div class="row size mt-2">
            <div class="col">
                {{ $store.getters.getCurrentPainting.height }}x{{ $store.getters.getCurrentPainting.long }}cm
            </div>
        </div>

        <div class="row style mt-2">
            <div class="col">
                {{ $store.getters.getCurrentPainting['style_' + $store.getters.getLanguage] }}, {{ $store.getters.getCurrentPainting['material_' + $store.getters.getLanguage] }}
            </div>
        </div>
        <div class="row mt-5" v-if="$store.getters.getCurrentPainting.price !== null">
            <div class="col buy-btn d-flex justify-content-center">
                <button @click="this.show = true" >{{this.buy_btn[$store.getters.getLanguage]}}</button>
            </div>
        </div>
        <div class="row mt-5">
            <ShareLinks/>
        </div>
    </div>
</template>

<script>

import ShareLinks from "./ShareLinks.vue";
import BackgroundImage from "../../UI/BackgroundImage.vue";
import BuyModal from "./BuyModal.vue";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

export default {
    components: {
        Carousel,
        Pagination,
        Slide,
        Navigation,
        BackgroundImage,
        BuyModal,
        ShareLinks,
    },

    data: () => ({
        show: false,
        buy_btn: {
            en: 'Buy',
            ua: 'Купити'
        }
    }),

    methods: {
        showModal(show){
            this.show = show;
        }
    },
}
</script>

<style scoped>
.mobile {
    height: 100%;
    padding-bottom: 50px !important;
    font-size: 36px;
    background: #eaeaea;
}

.price {
    font-weight: lighter;
}

.description {
    font-size: 30px;
}

.buy-btn button {
    width: 100%;
    padding: 15px 0px 15px 0px ;
}

</style>
