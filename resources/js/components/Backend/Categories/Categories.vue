<template>
    <alert-messages/>
    <edit-category-modal
        v-if="showEdit"
        @show="closeModal"
    />
    <create-category-model
        v-if="show"
        @show="closeModal"
    />
    <div class="container">
        <div class="row">
            <div class="col p-2 list">
                <div class="row">
                    <div class="col-2 d-flex justify-content-center">
                        <b>Назва категорії</b>
                    </div>
                    <div class="col-2 d-flex justify-content-center">
                        <b>Category name</b>
                    </div>
                    <div class="col-2 d-flex justify-content-center">
                        <b>Батьківська (Так або ім'я батьківської категорії)</b>
                    </div>
                    <div class="col-2 d-flex justify-content-center">
                        <b>Слаг</b>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                       <span @click="this.show = true"><b>+ Додати категорію</b></span>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center loader" v-if="$store.getters.getLoadingState">
                <loader/>
            </div>
            <div class="row categories pt-2" v-for="category in $store.getters.getAllCategories" v-if="$store.getters.getLoadingState === false">
                <div class="col-2 d-flex justify-content-center align-items-center">
                    {{category.name_ua}}
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    {{category.name_en}}
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center" v-if="category.parent_id == null">
                    Так
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center" v-else>
                    {{$store.getters.getParentCategories.filter((item) => {
                            return item.id === category.parent_id
}                   )[0].name_ua}}
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    {{category.slug}}
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <img src="../../../images/edit-btn.png" :id="category.id" @click="showEditModal" alt="edit" width="25"/>
                    <img src="../../../images/delete-btn.png" :id="category.id" @click="deleteCategory" alt="delete" width="25"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreateCategoryModel from "./components/CreateCategoryModal.vue";
import Loader from "../../UI/Loader.vue";
import AlertMessages from "../../UI/AlertMessages.vue";
import EditCategoryModal from "./components/EditCategoryModal.vue";

export default {
    components: {
        EditCategoryModal,
        Loader,
        CreateCategoryModel,
        AlertMessages,
    },
    data(){
        return {
            showEdit: false,
            show: false,
        }
    },

    methods: {
        async showEditModal(e){
            this.$store.dispatch('getCategoryById', e.target.id)

            this.showEdit = true;
        },

        async deleteCategory(e){
            axios.post('/api/delete-category', {
                category_id: e.target.id
            })
                .then(() => {
                    this.$store.commit('setMessage', {
                        type: 'success',
                        content: 'Категорія видалена',
                    })
                    this.$store.commit('deleteCategory', e.target.id)
                })
                .catch((err) => {
                    this.$store.commit('setMessage', {
                        type: 'error',
                        content: err.response.data.message,
                    })
                })
                .finally(() => {
                    setTimeout(() => {
                        this.$store.commit('setMessage', {
                            type: '',
                            content: '',
                        })
                    },3000)
                })
        },

        closeModal(show){
            this.show = show
            this.showEdit = show
        },

        getCategories(){
            this.$store.commit('setLoadingState', true)
            this.$store.dispatch('getCategories');

            setTimeout(() => {
                if(this.$store.getters.getAllCategories != []){
                    this.$store.commit('setLoadingState', false)
                }
            }, 100)
        }

    },

    mounted() {
        this.getCategories()

        this.$store.dispatch('getParentCategories');
    },

}
</script>

<style scoped>
img {
    cursor: pointer;
}


.loader {
    padding: 100px;
}

.list {
    margin-top: 80px;
    border-bottom: 1px solid black;
}

span:hover {
    transition: 0.2s;
    color: white;
    cursor: pointer;
}

img {
    margin-right: 5px;
}
</style>
