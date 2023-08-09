<template>
    <div class="container-fluid desktop">
        <div class="row">
            <div class="col p-5 label">
                <span class="display-5" ref="observe">
                    <a href="/">{{this.title[$store.getters.getLanguage]}}</a>
                </span>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col" v-for="category in $store.getters.getAllCategories">
                        <div class="row mt-1" style="cursor: pointer;" v-if="category.parent_id == null">
                            <router-link
                                :data-subcategory="''"
                                :data-category="category.slug"
                                @click="setPaintingsByCategory"
                                @mouseover="showSubcategories" :id="category.id"
                                :to="{
                                name: 'category',
                                params: {
                                   category_slug: category['slug']
                                }
                            }">{{category['name_' + $store.getters.getLanguage]}}</router-link>
                        </div>
                        <div class="subcategories" @mouseleave="showSubcategories">
                            <div class="" v-for="subcategory in $store.getters.getSubcategories" v-if="this.show_sub == category.id">
                                <div class="link">
                                    <router-link
                                        :to="{
                                        name: 'subcategory',
                                        params: {
                                            category_slug: category.name_en.toLowerCase(),
                                            subcategory_slug: subcategory.slug
                                        }
                                    }"
                                        :data-subcategory="subcategory.slug"
                                        :data-category="category.slug"
                                        @click="setPaintingsByCategory">
                                        {{subcategory['name_' + $store.getters.getLanguage]}}
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <div class="col-2">
                    <a href="https://www.facebook.com/dmytrodotsenko1865" style="
                                               font-size: 30px;
                                               font-weight: lighter;
                            "
                       target="_blank"
                    >
                        <img src="../../../images/facebook.png" width="30" height="30"/>
                    </a>
                </div>
                <div class="col">
                    <a href="https://www.instagram.com/dsdotsen/" style="
                                               font-size: 30px;
                                               font-weight: lighter;
                            "
                       target="_blank"
                    >
                        <img src="../../../images/instagram.svg" width="30" height="30"/>
                    </a>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col language">
                            <span @click="changeLang" id="EN" :class="this.current_language.EN">EN</span>
                            |
                            <span @click="changeLang" id="UA" :class="this.current_language.UA">UA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BurgerButton from "../../UI/BurgerButton.vue";
export default {
    components: {
        BurgerButton,
    },

    data() {
        return {
            current_language: {
                EN: '',
                UA: 'current_language',
            },

            title: {
              en: 'Dmytro Dotsenko',
              ua: 'Дмитро Доценко'
            },

            show_sub: false,
        }
    },


    methods: {
        showSubcategories(e){
            this.$store.dispatch('getSubcategories', {
                parent_id: e.target.id
            })

            if(this.show_sub != 0){
                this.show_sub = 0
                return;
            }

            this.show_sub = e.target.id
        },

        setPaintingsByCategory(e){
            this.$store.dispatch('getPaintingByCategorySlug', {
                category_slug: e.target.dataset.category,
                subcategory_slug: e.target.dataset.subcategory,
            });
        },

        changeLang(e) {
            let lang = e.target.id

            for (const key in this.current_language) {
                if(this.current_language[key] === 'current_language'){
                    this.current_language[key] = ''
                }
            }
            this.current_language[lang] = 'current_language'
            this.$store.commit('setLanguage', lang.toLowerCase())
        }

    },

}
</script>

<style scoped>
a {
    cursor: pointer;
    text-decoration: none;
    color: black;
}

.subcategories {
    border-radius: 10px;
    min-height: 60px;
    position: absolute;
    background: grey;
    margin-top: 10px;
    margin-left: -12px;
}

.label {
}

.link a {
    position: relative;
    color: white;
    padding: 10px;
    margin-right: 50px;
}

.current_language {
    transition: 0.2s;
    color: orange;
}

.language {
    cursor: pointer;
    font-size: 18px;
}

</style>
