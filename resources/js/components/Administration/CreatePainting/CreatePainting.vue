<template>
    <div class="container-fluid pb-5">
        <div class="col">
            <div class="row title mt-2">
                <h5>Добавити роботу</h5>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col">
                        <upload-image/>
                    </div>
                </div>
            </div>
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
                                    <span @click="language" id="UA" :class="this.lang.ua">Українська</span>
                                    /
                                    <span @click="language" id="EN" :class="this.lang.en">English</span>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="name" v-model="this.name" :placeholder="'Українська'" v-if="this.active === 'UA'">
                        <input type="text" name="name" v-model="this.name_en" :placeholder="'English'" v-if="this.active === 'EN'">
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Ціна</label>
                        <input type="text" name="price" v-model="this.price">
                    </div>
                    <div class="row mb-2 p-0">
                        <label for="">Опис</label>
                        <textarea rows="4" cols="50" name="description" v-model="this.description"/>
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
          width: 0,
          height: 0,
          long: 0,
          sold: '',
          images: [],
          lang: {
              ua: 'choose',
              en: '',
          },
          active: 'UA',
      }
    },

    methods: {
       async store() {
           // const fd = new FormData();
           // this.images.map(item => fd.append('images[]', item.file, item.file.name))
           // fd.append('name', this.name);
           // fd.append('price', this.price);
           // fd.append('description', this.description);
           // fd.append('width', this.width);
           // fd.append('height', this.height);
           // fd.append('long', this.long);this.lang
           // fd.append('sold_status', this.sold);
           axios.post('/administration/create-painting',{
                   name: this.name,
                   price: this.price,
                   description: this.description,
                   width: this.width,
                   height: this.height,
                   long: this.long,
                   sold_status: this.sold
           })
               .then((response) => {
                   console.log(response)
               })
               .catch((err) => {
                   console.log(err)
               })
       },

        language(e) {
            for (const lang in this.lang) {
                if(this.lang[lang] !== ''){
                    this.lang[lang] = ''
                }
            }

            this.lang[e.target.id] = 'choose'
            this.active = e.target.id
        }
    }

}
</script>

<style scoped>
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
