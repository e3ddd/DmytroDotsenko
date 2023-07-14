<template>
    <create-category-model
        v-if="show"
        @show="closeModal"
    />
    <div class="container">
        <div class="row">
            <div class="col p-2 list">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center">
                        <b>Назва категорії</b>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <b>Батьківська (Так або ID батьківської категорії)</b>
                    </div>
                    <div class="col d-flex justify-content-end">
                       <span @click="this.show = true"><b>+ Додати категорію</b></span>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center loader" v-if="this.loading">
                    <loader/>
                </div>
            </div>
            <div class="row categories pt-2" v-for="category in this.categories">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    {{category.name}}
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center" v-if="category.parent_id === null">
                    Так
                </div>

                <div class="col-4 d-flex justify-content-center align-items-center" v-else>
                    CHILD ID
                </div>


                <div class="col-1 d-flex justify-content-end">
                    <img src="../../../images/edit-btn.png" alt="edit" width="25"/>
                    <img src="../../../images/delete-btn.png" alt="delete" width="25"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreateCategoryModel from "./components/CreateCategoryModel.vue";
import Loader from "../../UI/Loader.vue";
export default {
    components: {
        Loader,
        CreateCategoryModel,
    },
    data(){
        return {
            categories: [],
            loading: false,
            show: false,
        }
    },

    methods: {
        closeModal(show){
          this.show = show
        },

        async getAllCategories(){
          this.loading = true
          axios.get('/api/get-all-categories')
              .then((response) => {
                  this.categories = response.data
                  this.loading = false
              })
              .catch(err => console.log(err))

        }
    },

    mounted() {
        this.getAllCategories()
    },

}
</script>

<style scoped>
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
