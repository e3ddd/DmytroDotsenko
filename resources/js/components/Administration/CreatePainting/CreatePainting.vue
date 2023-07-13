<template>
    <div class="row alert_message">
        <div class="col error" v-if="this.alert_message.type === 'error'">
            {{this.alert_message.content}}
        </div>
        <div class="col success" v-if="this.alert_message.type === 'success'">
            {{this.alert_message.content}}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row title mt-2" >
                    <h5>Добавити роботу</h5>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="row">
                        <div class="col-xxl">
                            <upload-image
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
                            <div class="col p-0 d-flex justify-content-end create-btn" v-if="!this.edit">
                                <button @click="store">Створити</button>
                            </div>
                            <div class="col p-0 d-flex justify-content-end create-btn" v-if="this.edit">
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
import CreateFields from "./components/CreateFields.vue";
import UploadImage from "./components/UploadImage.vue";
export default {
    components: {
        UploadImage,
        CreateFields,
    },

    data() {
      return {
          painting: {
              name: '',
              name_en: '',
              price: 0,
              description: '',
              description_en: '',
              year: '',
              width: 0,
              height: 0,
              long: 0,
              sold_status: '',
          },
          images: [],

          alert_message: {
              type: '',
              content: '',
          },
          edit: false,
      }
    },

    mounted() {
        this.editPainting()
    },

    methods: {

        async editPainting(){
          if(this.$route.params.id != null){
              this.edit = true;
                axios.get('/api/get-painting-by-id', {
                    params: {
                        id: this.$route.params.id,
                    }
            })
                .then((response) => {
                        this.painting = response.data
                })
                .catch((err) => {
                    console.log(err.response.data.message)
                })
          }
        },

        onUpdateImages(images) {
            if(this.images.length !== 0){
                this.images = []
            }
            this.images.push(images)
        },

        async update() {
            let fd = new FormData()

            if(this.painting.sold_status){
                this.painting.sold_status = 1
            }

            if(!this.painting.sold_status){
                this.painting.sold_status = 0
            }

            fd.append('painting[name]', this.painting.name)
            fd.append('painting[name_en]', this.painting.name_en)
            fd.append('painting[price]', this.painting.price)
            fd.append('painting[description]', this.painting.description)
            fd.append('painting[description_en]', this.painting.description_en)
            fd.append('painting[year]', this.painting.year)
            fd.append('painting[width]', this.painting.width)
            fd.append('painting[height]', this.painting.height)
            fd.append('painting[long]', this.painting.long)
            fd.append('painting[sold_status]', this.painting.sold_status)

            fd.append('painting_id', this.$route.params.id)

            axios.post('/api/update-painting', fd, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.alert_message.type = 'success'
                    this.alert_message.content = 'Зміни внесені до каталогу'

                    setTimeout(() => {
                        this.alert_message.type = ''
                        this.alert_message.content = ''
                    }, 5000)
                })
                .catch(err => {
                    this.alert_message.content = err.response.data.message
                    this.alert_message.type = 'error'
                    setTimeout(() => {
                        this.alert_message.type = ''
                        this.alert_message.content = ''
                    }, 5000)
                })
        },

        async store() {
            if(this.images.length !== 0){
                let fd = new FormData()
                this.images[0].map((item, key) => fd.append('images[' + key + ']', item.file, item.file.name));
                fd.append('name', this.name)
                fd.append('name_en', this.name_en)
                fd.append('price', this.price)
                fd.append('description', this.description)
                fd.append('description_en', this.description_en)
                fd.append('year', this.year)
                fd.append('width', this.width)
                fd.append('height', this.height)
                fd.append('long', this.long)

                if(this.sold){
                    this.sold = 1
                }else{
                    this.sold = 0
                }

                fd.append('sold_status', this.sold)
                axios.post('/api/create-painting', fd, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        this.alert_message.type = 'success'
                        this.alert_message.content = 'Картина додана до каталогу'

                        this.images = []
                        this.name = ''
                        this.name_en = ''
                        this.price = ''
                        this.description = ''
                        this.description_en = ''
                        this.year = ''
                        this.width = ''
                        this.height = ''
                        this.long = ''

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
            }
       },
    }

}
</script>

<style scoped>
.title h5 {
    top: -100% !important;
}

.alert_message {
    position: fixed;
    z-index: 99;
    left: 47%;
    top: -1px;
    color: #ffffff;
    font-size: 14px;
    width: 300px !important;
    height: 60px;
}

.error {
    background: #fe3939;
}

.success {
    background: #00ba0c;
}

</style>
