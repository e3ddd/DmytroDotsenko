<template>
    <div class="create-category-modal" @click="this.$emit('show', false)">
        <div @click.stop class="create-category-item">
            <div class="row">
                <div class="col-9">
                    <h5>Назва категорії</h5>
                </div>
                <div class="col languages">
                    <span @click="language" id="name_ua" :class="this.lang.name._ua">Українська</span>
                    /
                    <span @click="language" id="name_en" :class="this.lang.name._en">English</span>
                </div>
            </div>
            <div class="row">
                <input type="text" name="name" placeholder="Українська" v-model="this.category.name_ua" v-if="this.lang.name.active === 'name_ua'">
                <input type="text" name="name" placeholder="English" v-model="this.category.name_en" v-if="this.lang.name.active === 'name_en'">
            </div>
            <div class="row pt-2 mb-2 p-0">
                <label for="">Слаг</label>
                <input type="text" placeholder="example-slug" v-model="category.slug">
            </div>
            <div class="row">
                <div class="col-1 mt-2">
                    <input type="checkbox" v-model="this.category.parent_id">
                </div>
                <div class="col mt-1">
                    <label for="">Батьківська категорія</label>
                </div>
            </div>
            <div class="row" v-if="this.category.parent_id !== true">
                <div class="col pt-2 pb-2">
                    <div class="row mb-2">
                        <label for="">Обрати батьківську категорію</label>
                    </div>
                    <div class="row">
                        <select name="categories" id="" v-model="this.category.parent_id">
                            <option disabled selected>Батьківська категорія...</option>
                            <option :value="category.id" v-for="category in $store.getters.getParentCategories">
                                {{category.name}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end align-items-end mt-2 p-0">
                    <button @click="store">Стровити</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lang: {
                name: {
                    _ua: 'choose',
                    _en: '',
                    active: 'name_ua',
                },
            },

            category: {
                name_ua: '',
                name_en: '',
                parent_id: '',
                slug: '',
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
        },

        async store(){
            if(this.category.parent_id === true){
                this.category.parent_id = null
            }

            axios.post('/api/store-category', {
                category: this.category
            })
                .then((response) => {
                    this.$store.commit('setMessage', {
                        type: 'success',
                        content: 'Категорію додано',
                    })
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
    }

}
</script>

<style scoped>

label {
    font-size: 14px;
}

.choose {
    color: #006bf7;
}

.create-category-modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
    z-index: 100;
}

.create-category-item {
    padding: 30px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

.languages {
    cursor: pointer;
    display: flex;
    justify-content: end;
    font-size: 12px;
}


</style>
