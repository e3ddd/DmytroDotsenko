<template>
    <div class="row alert_message">
        <div class="col error" v-if="this.alert_message.type === 'error'">
            {{this.alert_message.content}}
        </div>
        <div class="col success" v-if="this.alert_message.type === 'success'">
            {{this.alert_message.content}}
        </div>
    </div>
    <div class="container-fluid pb-5">
        <div class="col">
            <div class="row title mt-2">
                <h5>Добавити роботу</h5>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col">
                        <upload-image
                            @getImages="onUpdateImages"
                        />
                    </div>
                </div>
            </div>
            <form @submit.prevent enctype="multipart/form-data">
            <div class="row">
                <div class="col-2"></div>
                <div class="col">
                    <div class="row mb-2 p-0">
                        <div class="col p-0">
                            <div class="row">
                                <div class="col-9">
                                    <label for="">Назва</label>
                                </div>
                                <div class="col languages">
                                    <span @click="language" id="name_ua" :class="this.lang.name._ua">Українська</span>
                                    /
                                    <span @click="language" id="name_en" :class="this.lang.name._en">English</span>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="name" v-model="this.name" :placeholder="'Українська'" v-if="this.lang.name.active === 'name_ua'">
                        <input type="text" name="name" v-model="this.name_en" :placeholder="'English'" v-if="this.lang.name.active === 'name_en'">
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Ціна</label>
                        <input type="text" name="price" v-model="this.price">
                    </div>
                    <div class="row mb-2 p-0">
                        <div class="col p-0">
                            <div class="row">
                                <div class="col-9">
                                    <label for="">Опис</label>
                                </div>
                                <div class="col languages">
                                    <span @click="language" id="desc_ua" :class="this.lang.desc._ua">Українська</span>
                                    /
                                    <span @click="language" id="desc_en" :class="this.lang.desc._en">English</span>
                                </div>
                            </div>
                        </div>
                        <textarea rows="4" cols="50" name="description" v-model="this.description" v-if="this.lang.desc.active === 'desc_ua'"/>
                        <textarea rows="4" cols="50" name="description" v-model="this.description_en" v-if="this.lang.desc.active === 'desc_en'"/>
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Рік</label>
                        <input type="text" v-model="this.year">
                    </div>

                    <div class="row mb-2 p-0">
                        <label for="">Ширина</label>
                        <input type="text" v-model="this.width">
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Висота</label>
                        <input type="text" v-model="this.height">
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Довжина</label>
                        <input type="text" v-model="this.long">
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col-3 p-0">
                                    <label for="sold">
                                        Продана
                                    </label>
                                </div>
                                <div class="col checkbox">
                                    <input type="checkbox" v-model="this.sold" id="sold">
                                </div>
                            </div>
                        </div>
                        <div class="col p-0 d-flex justify-content-end create-btn">
                            <button @click="store">Створити</button>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
import UploadImage from "./components/UploadImage.vue";
export default {
    components: {
        UploadImage,
    },

    data() {
      return {
          name: '',
          name_en: '',
          price: 0,
          description: '',
          description_en: '',
          year: '',
          width: 0,
          height: 0,
          long: 0,
          sold: '',
          images: [],
          lang: {
              desc: {
                  _ua: 'choose',
                  _en: '',
                  active: 'desc_ua',
              },
              name: {
                  _ua: 'choose',
                  _en: '',
                  active: 'name_ua',
              },
          },
          alert_message: {
              type: '',
              content: '',
          },
      }
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
                axios.post('/administration/create-painting', fd, {
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

        language(e) {
            const lang = e.target.id.substr(-3)
            const field = e.target.id.replace(lang, '')

            for (const lang in this.lang[field]) {
                if(lang !== 'active'){
                    if(this.lang[field][lang] !== ''){
                        this.lang[field][lang] = ''
                    }
                }
            }

            this.lang[field][lang] = 'choose'
            this.lang[field].active = e.target.id
        }
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

.choose {
    color: #006bf7;
}

span {
    cursor: pointer;
}

.checkbox {
    margin-top: 4px;
    padding: 0 !important;
}

label {
    font-size: 12px;
    padding: 0;
}

.languages {
    font-size: 12px;
}

::placeholder {
    font-size: 12px;
}
</style>
