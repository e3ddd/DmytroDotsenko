<template>
    <div class="row mb-2 p-0">
        <div class="col p-0">
            <div class="row">
                <div class="col">
                    <label for="">Категорія</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select name="categories" v-model="painting.category_id">
                        <option disabled selected>Обрати категорію...</option>
                        <option :value="category.id" v-for="category in $store.getters.getAllCategories">
                            {{category.name}}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2 p-0">
        <label for="">Слаг</label>
        <input type="text" placeholder="example-slug" v-model="painting.slug">
    </div>
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
        <input type="text" name="name" v-model="painting.name_ua" placeholder="Українська" v-if="this.lang.name.active === 'name_ua'">
        <input type="text" name="name" v-model="painting.name_en" placeholder="English" v-if="this.lang.name.active === 'name_en'">
    </div>
    <div class="row mb-2 p-0">
        <label for="">Ціна</label>
        <input type="text" name="price" v-model="painting.price">
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
        <textarea rows="4" cols="50" name="description" placeholder="Українська" v-model="painting.description_ua" v-if="this.lang.desc.active === 'desc_ua'"/>
        <textarea rows="4" cols="50" name="description" placeholder="English" v-model="painting.description_en" v-if="this.lang.desc.active === 'desc_en'"/>
    </div>
    <div class="row mb-2 p-0">
        <label for="">Рік</label>
        <input type="text" v-model="painting.year">
    </div>
    <div class="row mb-2 p-0">
        <div class="col p-0">
            <div class="row">
                <div class="col-9">
                    <label for="">Матеріал</label>
                </div>
                <div class="col languages">
                    <span @click="language" id="material_ua" :class="this.lang.material._ua">Українська</span>
                    /
                    <span @click="language" id="material_en" :class="this.lang.material._en">English</span>
                </div>
            </div>
        </div>
        <input name="material" v-model="painting.material_ua" placeholder="Українська" v-if="this.lang.material.active === 'material_ua'"/>
        <input name="material" v-model="painting.material_en" placeholder="English" v-if="this.lang.material.active === 'material_en'"/>
    </div>
    <div class="row mb-2 p-0">
        <div class="col p-0">
            <div class="row">
                <div class="col-9">
                    <label for="">Техніка</label>
                </div>
                <div class="col languages">
                    <span @click="language" id="style_ua" :class="this.lang.style._ua">Українська</span>
                    /
                    <span @click="language" id="style_en" :class="this.lang.style._en">English</span>
                </div>
            </div>
        </div>
        <input name="material" v-model="painting.style_ua" placeholder="Українська" v-if="this.lang.style.active === 'style_ua'"/>
        <input name="material" v-model="painting.style_en" placeholder="English" v-if="this.lang.style.active === 'style_en'"/>
    </div>
    <div class="row mb-2 p-0">
        <label for="">Висота</label>
        <input type="text" v-model="painting.height">
    </div>
    <div class="row mb-2 p-0">
        <label for="">Довжина</label>
        <input type="text" v-model="painting.long">
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
                    <input type="checkbox" @click="painting.sold_status = !painting.sold_status" :value="painting.sold_status" v-if="painting.sold_status" id="sold" checked>
                    <input type="checkbox" @click="painting.sold_status = !painting.sold_status" :value="painting.sold_status" v-else id="sold" >
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        painting: [Object, Array],
    },

    data() {
        return {
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
                material: {
                    _ua: 'choose',
                    _en: '',
                    active: 'material_ua',
                },
                style: {
                    _ua: 'choose',
                    _en: '',
                    active: 'style_ua',
                },
            },
        }
    },

    methods: {

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
