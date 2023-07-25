<template>
    <Carousel>
        <Slide v-for="image in images"
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
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import BackgroundImage from "../../../UI/BackgroundImage.vue";
export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        BackgroundImage
    },

    props: {
        images: [Object, Array],
    },
}
</script>

<style scoped>

</style>
