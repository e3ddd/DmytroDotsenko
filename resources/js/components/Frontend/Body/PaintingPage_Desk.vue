<template>
    <ImageModal
        v-if="show"
        @show="showModal"
    />
    <div class="container-fluid desktop d-flex justify-content-center">
        <div class="row w-50">
            <div class="col carousel">
                <Carousel>
                    <Slide v-for="image in $store.getters.getCurrentPainting.images"
                           :key="image.id">
                        <background-image
                            :id="image.id"
                            @click="openModal"
                            :path="'/storage/images/' + image.painting_id + '_' + image.hash_id"
                        />
                    </Slide>
                    <template #addons>
                        <Navigation />
                        <Pagination />
                    </template>
                </Carousel>
            </div>
            <div class="col content">
                <div class="row">
                    <div class="col">
                        <h1>{{ $store.getters.getCurrentPainting['name_' + $store.getters.getLanguage] }}</h1>
                    </div>
                </div>
                <div class="row price" v-if="$store.getters.getCurrentPainting.price !== null">
                    {{ $store.getters.getCurrentPainting.price }} y.o.
                </div>

                <div class="row description">
                    <div class="col">
                        {{ $store.getters.getCurrentPainting['description_' + $store.getters.getLanguage] }}
                    </div>
                </div>
                <div class="row size">
                    <div class="col">
                        {{ $store.getters.getCurrentPainting.height }}x{{ $store.getters.getCurrentPainting.long }}cm
                    </div>
                </div>

                <div class="row style">
                    <div class="col">
                        {{ $store.getters.getCurrentPainting['style_' + $store.getters.getLanguage] }}, {{ $store.getters.getCurrentPainting['material_' + $store.getters.getLanguage] }}
                    </div>
                </div>
                <div class="row share_links">
                    <div class="col">
                        <ShareLinks/>
                    </div>
<!--                    <div class="col-2С d-flex justify-content-center">-->
<!--                        <div class="row" v-if="$store.getters.getCurrentPainting.price !== null">-->
<!--                            <div class="col buy-btn d-flex justify-content-center">-->
<!--                                <button @click="this.show = true" >{{this.buy_btn[$store.getters.getLanguage]}}</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ImageModal from "./ImageModal.vue";
import BuyModal from "./BuyModal.vue";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import BackgroundImage from "../../UI/BackgroundImage.vue";
import ShareLinks from "./ShareLinks.vue";

export default {
    components: {
        Carousel,
        Pagination,
        Slide,
        Navigation,
        BackgroundImage,
        BuyModal,
        ShareLinks,
        ImageModal
    },

    data: () => ({
        show: false,
        buy_btn: {
            en: 'Buy',
            ua: 'Купити'
        }
    }),

    methods: {
        openModal(e){
            this.$store.commit('setCurrentImage', e.target.id);
            this.show = true;
        },

        showModal(show) {
            this.show = show
        }
    },

}
</script>

<style scoped>
.price {
    font-weight: bolder;
    padding-left: 10px;
}

.content {
    position: relative;
    margin-top: 5%;
}

.share_links {
    position: absolute;
    bottom: 0;
}



</style>
