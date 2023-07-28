<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col p-5 label">
                <span class="display-5" ref="observe">
                    <router-link to="/">dsdotsen</router-link>
                </span>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col" v-for="category in $store.getters.getAllCategories">
                        <div class="row mt-1" style="cursor: pointer;" @click="showSubcategories" :id="category.id"  v-if="category.parent_id == null">
                            {{category['name_' + $store.getters.getLanguage]}}
                        </div>
                        <div class="subcategories">
                            <div class="" v-for="subcategory in $store.getters.getSubcategories" v-if="this.show_sub == category.id">
                                <div class="link">
                                    <router-link :to="'/' + category.name_en.toLowerCase() + '/' + subcategory.slug" :data-subcategory="subcategory.slug" :data-category="category.slug" @click="setPaintingsByCategory">{{subcategory['name_' + $store.getters.getLanguage]}}</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <div class="col-3">
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

            trans: {
                home: {
                    en: 'Home',
                    ua: 'Домівка',
                }
            },

            show_sub: false,
        }
    },


    methods: {
        showSubcategories(e){
            console.log(e.target.id)
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
    position: absolute;
    background: black;
    margin-top: 10px;
    margin-left: -50px;
}

.link a {
    position: relative;
    margin: 50px;
    color: white;
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
