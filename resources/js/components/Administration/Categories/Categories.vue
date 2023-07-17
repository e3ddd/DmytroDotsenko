<template>
    <alert-messages
        :type="this.alert_message.type"
        :content="this.alert_message.content"
    />
    <create-category-model
        :categories="this.categories"
        v-if="show"
        @show="closeModal"
        @alert="alertMessage"
    />
    <div class="container">
        <div class="row">
            <div class="col p-2 list">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center">
                        <b>Назва категорії</b>
                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <b>Category name</b>
                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <b>Батьківська (Так або ID батьківської категорії)</b>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                       <span @click="this.show = true"><b>+ Додати категорію</b></span>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center loader" v-if="this.loading">
                    <loader/>
                </div>
            </div>
            <div class="row categories pt-2" v-for="category in this.categories">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    {{category.name}}
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    {{category.name_en}}
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center" v-if="category.parent_id == null">
                    Так
                </div>

                <div class="col-3 d-flex justify-content-center align-items-center" v-else>
                    {{category.parent_id}}
                </div>

                <div class="col-1 d-flex justify-content-end">
<!--                    <img src="../../../images/edit-btn.png" alt="edit" width="25"/>-->
                    <img src="../../../images/delete-btn.png" :id="category.id" @click="deleteCategory" alt="delete" width="25"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreateCategoryModel from "./components/CreateCategoryModel.vue";
import Loader from "../../UI/Loader.vue";
import AlertMessages from "../../UI/AlertMessages.vue";
export default {
    components: {
        Loader,
        CreateCategoryModel,
        AlertMessages,
    },
    data(){
        return {
            categories: [],
            loading: false,
            show: false,

            alert_message: {
                type: '',
                content: '',
            },
        }
    },

    methods: {
        async deleteCategory(e){

            axios.post('/api/delete-category', {
                category_id: e.target.id
            })
                .then(() => {
                    this.alert_message.type = 'success'
                    this.alert_message.content = 'Категорія видалена'
                    this.categories = this.categories.filter(item => item.id != e.target.id)
                })
                .catch((err) => {
                    this.alert_message.content = err.response.data.message
                    this.alert_message.type = 'error'
                })
                .finally(() => {
                    setTimeout(() => {
                        this.alert_message.type = ''
                        this.alert_message.content = ''
                    }, 5000)
                })
        },

        alertMessage(alertMessage) {
            this.alert_message.type = alertMessage.type
            this.alert_message.content = alertMessage.content

            this.show = false

            setTimeout(() => {
                this.alert_message.type = ''
                this.alert_message.content = ''
                // location.reload()
            }, 5000)
        },

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
