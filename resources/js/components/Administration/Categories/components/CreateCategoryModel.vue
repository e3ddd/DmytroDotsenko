<template>
    <div class="create-category-modal" @click="this.$emit('show', false)">
        <div @click.stop class="create-category-item">
            <div class="row">
                <div class="col-9">
                    <label for="">Назва категорії</label>
                </div>
                <div class="col languages">
                    <span @click="language" id="name_ua" :class="this.lang.name._ua">Українська</span>
                    /
                    <span @click="language" id="name_en" :class="this.lang.name._en">English</span>
                </div>
            </div>
            <div class="row">
                <input type="text" name="name" v-model="this.category.name" v-if="this.lang.name.active === 'name_ua'">
                <input type="text" name="name" v-model="this.category.name_en" v-if="this.lang.name.active === 'name_en'">
            </div>
            <div class="row">
                <div class="col-1 mt-2">
                    <input type="checkbox" v-model="this.category.parent_id">
                </div>
                <div class="col mt-1">
                    <label for="">Батьківська категорія</label>
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
            category: {
                name: '',
                name_en: '',
                parent_id: 0,
            },

            lang: {
                name: {
                    _ua: 'choose',
                    _en: '',
                    active: 'name_ua',
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
        },

        async store(){

            if(this.category.parent_id){
                this.category.parent_id = null
            }

            axios.post('/api/store-category', {
                category: this.category
            })
                .then(response => console.log(response))
                .catch(err => console.log(err))
        }
    }

}
</script>

<style scoped>

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
