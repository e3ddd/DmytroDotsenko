<template>
    <alert-messages
        :type="this.alert_message.type"
        :content="this.alert_message.content"
    />
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <edit-images
                    @updateImage="updateImage"
                    @deleteImage="deleteFilter"
                    :images="this.images"
                />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form @submit.prevent enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-2"></div>
                        <div class="col">
                            <create-fields
                                :painting="this.painting"
                                v-model="this.painting"
                            />
                            <div class="col p-0 d-flex justify-content-end create-btn">
                                <button @click="update">Змінити</button>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import EditImages from "./components/EditImages.vue";
import CreateFields from "./components/CreateFields.vue";
import AlertMessages from "../../UI/AlertMessages.vue";
export default {
    components: {
        EditImages,
        AlertMessages,
        CreateFields
    },

    data() {
        return {
            painting: {
                slug: '',
                name_ua: '',
                name_en: '',
                price: '',
                description_ua: '',
                description_en: '',
                year: '',
                material_ua: '',
                material_en: '',
                style_ua: '',
                style_en: '',
                height: 0,
                long: 0,
                sold_status: '',
                category_id: '',
                subcategory_id: '',
                order: 0,
            },

            images: [],

            alert_message: {
                type: '',
                content: '',
            },
        }
    },

    mounted() {
        this.getPainting()
        this.$store.dispatch('getCategories')
    },

    methods: {
        deleteFilter(image_id) {
            this.deleteImage(image_id)
            setTimeout(() => {
                if(this.alert_message.type !== 'error'){
                    this.images = this.images.filter(item => item.id !== image_id)
                }
            }, 100)
        },

        updateImage(image) {
            this.storeImage(this.$route.params.id, image)
            // setTimeout(() => {
            //     location.reload()
            // }, 100)
        },

        async getPainting(){
                axios.get('/api/get-painting-by-id', {
                    params: {
                        id: this.$route.params.id,
                    }
                })
                    .then((response) => {
                        this.painting = response.data
                        this.images = response.data.images
                    })
                    .catch((err) => {
                        console.log(err.response.data.message)
                    })
        },

        async storeImage(painting_id, image){
            const fd = new FormData();

            fd.append('painting_id', painting_id)
            fd.append('image', image.file, image.file.name)

            axios.post('/api/store-painting-image', fd, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }) .then((response) => {
                this.alert_message.type = 'success'
                this.alert_message.content = 'Картина додана до каталогу'
                setTimeout(() => {
                    this.alert_message.type = ''
                    this.alert_message.content = ''
                }, 5000)
            })
                .catch((err) => {
                    this.alert_message.content = err.response.data.message
                    this.alert_message.type = 'error'
                    setTimeout(() => {
                        this.alert_message.type = ''
                        this.alert_message.content = ''
                    }, 5000)
                })

        },

        async deleteImage(image_id) {
            axios.post('/api/delete-painting-image', {
                image_id: image_id
            })
                .catch((err) => {
                    this.alert_message.content = err.response.data.message
                    this.alert_message.type = 'error'
                    setTimeout(() => {
                        this.alert_message.type = ''
                        this.alert_message.content = ''
                    }, 5000)
                })
        },

        async update() {

            let fd = new FormData()

            if(this.painting.sold_status){
                this.painting.sold_status = 1
            }

            if(!this.painting.sold_status){
                this.painting.sold_status = 0
            }

            if(this.painting.subcategory_id !== ''){
                this.painting.category_id = this.painting.subcategory_id;
            }

            fd.append('painting[slug]', this.painting.slug)
            fd.append('painting[name_ua]', this.painting.name_ua)
            fd.append('painting[name_en]', this.painting.name_en)

            if(this.painting.price != null){
                fd.append('painting[price]', this.painting.price)
            }

            if(this.painting.category_id != null){
                fd.append('painting[category_id]', this.painting.category_id)
            }

            fd.append('painting[description_ua]', this.painting.description_ua)
            fd.append('painting[description_en]', this.painting.description_en)
            fd.append('painting[year]', this.painting.year)
            fd.append('painting[material_ua]', this.painting.material_ua)
            fd.append('painting[material_en]', this.painting.material_en)
            fd.append('painting[style_ua]', this.painting.style_ua)
            fd.append('painting[style_en]', this.painting.style_en)
            fd.append('painting[height]', this.painting.height)
            fd.append('painting[long]', this.painting.long)
            fd.append('painting[sold_status]', this.painting.sold_status)
            fd.append('painting[order]', this.painting.order)


            fd.append('painting_id', this.$route.params.id)

            axios.post('/api/update-painting', fd, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {

                    this.$store.commit('setMessage', {
                        content: 'Зміни внесені до каталогу',
                        type: 'success'
                    })

                    setTimeout(() => {
                        this.$store.commit('setMessage', {
                            content: '',
                            type: ''
                        })
                    }, 5000)
                })
                .catch(err => {
                    this.$store.commit('setMessage', {
                        content: err.response.data.message,
                        type: 'error'
                    })
                    setTimeout(() => {
                        this.$store.commit('setMessage', {
                            content: '',
                            type: ''
                        })
                    }, 5000)
                })
        },
    }
}
</script>

<style scoped>

</style>
