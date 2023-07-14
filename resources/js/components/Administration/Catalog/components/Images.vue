<template>
    <Carousel>
        <Slide v-for="image in images"
               :key="image.id">
            <img :src="'/storage/images/' + image.painting_id + '_' + image.hash_id" alt="main_image" height="300">
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
export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },

    props: {
        images: [Object, Array],
    },
}
</script>

<style scoped>

</style>
