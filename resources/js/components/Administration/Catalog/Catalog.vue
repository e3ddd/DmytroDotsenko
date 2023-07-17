<template>
    <div class="container catalog">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center" style="padding: 300px" v-if="this.loading">
                <loader/>
            </div>
            <div class="col">
                <div class="row" v-for="painting in this.paintings">
                    <div class="col-5 pt-4 images">
                        <images
                            :images="painting.images"
                        />
                    </div>
                    <div class="col-7 pt-4">
                        <content
                            :painting="painting"
                        />
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
import Images from "./components/Images.vue";
import Content from "./components/Content.vue";
import Loader from "../../UI/Loader.vue";
import PagePagination from "../../Pagination.vue";
export default {
    components: {
        Loader,
        PagePagination,
        Images,
        Content,
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
            this.loading = true
            axios.get('/api/get-all-painting-with-pagination?page=' + page, )
                .then((response) => {
                    this.paintings = response.data.data
                    this.total = Math.ceil(response.data.total / response.data.per_page)
                })
                .catch(err => console.log(err))
                .finally(() => {
                    this.loading = false
                })
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
