<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row" v-for="painting in this.paintings">
                    <div class="col" v-if="this.loading"></div>
                    <div class="col pt-4 images">
                        <Carousel>
                            <Slide v-for="image in painting.images"
                                   :key="image.id">
<!--                                <div class="img" :style="{background: 'url(' + '/storage/images/' + image.painting_id + '_' + image.hash_id + ')'}"></div>-->
                                <img :src="'/storage/images/' + image.painting_id + '_' + image.hash_id" alt="main_image" height="400">
                            </Slide>
                            <template #addons>
                                <Navigation />
                                <Pagination />
                            </template>
                        </Carousel>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col">
                                Назва
                            </div>
                            <div class="col">
                                {{painting.name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="this.paintings.length !== 0">
            <PagePagination
                v-if="this.total"
                :total="this.total"
                :get="this.getPaintings"
                @update="this.onUpdate"
            />
        </div>
    </div>
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import PagePagination from "../../Pagination.vue";
export default {
    components: {
        PagePagination,
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        return {
            paintings: [],
            total: 0,
            page: 1,
            loading: false,
        }
    },

    mounted() {
            this.getPaintings(this.page)
        },

    methods: {

        onUpdate(paintings) {
            this.paintings = paintings

        },

        async getPaintings(page){
            axios.get('/get-all-painting-with-pagination?page=' + page, )
                .then((response) => {
                    this.paintings = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                })
                .catch(err => console.log(err))
        }
    },

}
</script>

<style scoped>
.images {
    position: relative;
    z-index: 99;
}
</style>
