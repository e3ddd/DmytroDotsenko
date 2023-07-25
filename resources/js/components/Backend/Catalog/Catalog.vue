<template>
    <div class="container catalog">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center" style="padding: 300px" v-if="this.loading">
                <loader/>
            </div>
            <div class="col">
                <div class="row" v-for="painting in $store.getters.getAllPaintings">
                    <div class="col pt-4 images">
                        <images
                            :images="painting.images"
                        />
                    </div>
                    <div class="col pt-4">
                        <content
                            :painting="painting"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <PagePagination
                @update="this.onUpdate"
            />
        </div>
    </div>
</template>

<script>
import Images from "./components/Images.vue";
import Content from "./components/Content.vue";
import Loader from "../../UI/Loader.vue";
import PagePagination from "../../UI/Pagination.vue";
import {mapGetters} from "vuex";
export default {
    components: {
        Loader,
        PagePagination,
        Images,
        Content,
    },
    data() {
        return {
            page: 1,
            loading: false,
        }
    },


    methods: {
        onUpdate(paintings) {
             this.$store.commit('setPaintings', paintings)
        },
    },

    mounted() {
        this.$store.dispatch('getPaintings');
    }

}
</script>

<style scoped>
.images {
    z-index: 99;
}

</style>
