<template>
    <alert-messages/>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row title mt-2" >
                    <h5>Додати роботу</h5>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="row">
                        <div class="col-xxl">
                            <upload-image
                                :files="this.images"
                                @getImages="onUpdateImages"
                            />
                        </div>

                    </div>
                </div>
                <form @submit.prevent enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-2"></div>
                        <div class="col">
                            <create-fields
                                :painting="this.painting"
                                v-model="this.painting"
                            />
                            <div class="col p-0 d-flex justify-content-end create-btn">
                                <button @click="store">Створити</button>
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
import AlertMessages from "../../UI/AlertMessages.vue";
import CreateFields from "./components/CreateFields.vue";
import UploadImage from "./components/UploadImages.vue";
export default {
    components: {
        AlertMessages,
        UploadImage,
        CreateFields,
    },

    data() {
      return {
          painting: {
              slug: '',
              name_ua: '',
              name_en: '',
              price: 0,
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
          },
          images: [],
      }
    },

    mounted() {
        this.$store.dispatch('getCategories')
    },

    methods: {
        onUpdateImages(images) {
            if(this.images.length !== 0){
                this.images = []
            }
            this.images.push(images)
        },

        async store() {
            if(this.images.length !== 0){
                let fd = new FormData()
                this.images[0].map((item, key) => fd.append('images[' + key + ']', item.file, item.file.name));
                fd.append('painting[slug]', this.painting.slug)
                fd.append('painting[name_ua]', this.painting.name_ua)
                fd.append('painting[name_en]', this.painting.name_en)
                fd.append('painting[price]', this.painting.price)
                fd.append('painting[description_ua]', this.painting.description_ua)
                fd.append('painting[description_en]', this.painting.description_en)
                fd.append('painting[year]', this.painting.year)
                fd.append('painting[material_ua]', this.painting.material_ua)
                fd.append('painting[material_en]', this.painting.material_en)
                fd.append('painting[style_ua]', this.painting.style_ua)
                fd.append('painting[style_en]', this.painting.style_en)
                fd.append('painting[height]', this.painting.height)
                fd.append('painting[long]', this.painting.long)
                fd.append('painting[category_id]', this.painting.category_id)

                if(this.painting.sold_status){
                    this.painting.sold_status = 1
                }else{
                    this.painting.sold_status = 0
                }

                fd.append('painting[sold_status]', this.painting.sold_status)
                axios.post('/api/create-painting', fd, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        this.$store.commit('setMessage', {
                            type: 'success',
                            content: 'Роботу додано у каталог',
                        })

                        this.images = []
                        this.name = ''
                        this.name_en = ''
                        this.price = ''
                        this.description = ''
                        this.description_en = ''
                        this.year = ''
                        this.material = ''
                        this.style = ''
                        this.height = ''
                        this.long = ''

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
            }
       },
    }

}
</script>

<style scoped>
.title h5 {
    top: -100% !important;
}
</style>
