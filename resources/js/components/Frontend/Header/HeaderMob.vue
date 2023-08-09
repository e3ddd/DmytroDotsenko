<template>
    <div class="container-fluid header mobile">
        <div class="row nav-menu-row" v-if="this.active">
            <div class="col p-5 nav-menu" :class="this.animate">
                <div class="row" v-for="category in this.$store.getters.getAllCategories">
                    <div class="col-2">
                        <div class="row">
                            <div class="col ">
                                <div class="row category" :id="category.id" @click="showSubcategories"  v-if="category.parent_id == null">
                                    {{category['name_' + $store.getters.getLanguage]}}
                                </div>
                                <div class="row mt-3 subcategories" v-for="subcategory in $store.getters.getSubcategories" v-if="this.show_sub == category.id">
                                    <router-link :to="'/' + category.name_en.toLowerCase() + '/' + subcategory.slug" :data-subcategory="subcategory.slug" :data-category="category.slug" @click="setPaintingsByCategory">{{subcategory['name_' + $store.getters.getLanguage]}}</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col p-0">
                        <router-link to="/" style="
                                               font-size: 24px;
                                               font-weight: lighter;
                            ">
                            {{this.trans.home[$store.getters.getLanguage]}}
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 p-0 inst">
                        <a href="https://www.instagram.com/dsdotsen/" style="
                                               font-size: 30px;
                                               font-weight: lighter;
                            "
                           target="_blank"
                        >
                            <img src="../../../images/instagram.svg" width="30" height="30"/>
                        </a>
                    </div>
                    <div class="col pt-0 language">
                        <div class="row">
                            <div class="col">
                                <span @click="changeLang" id="EN" :class="this.current_language.EN">EN</span>
                                |
                                <span @click="changeLang" id="UA" :class="this.current_language.UA">UA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 pt-5 pb-5 pl-3 pr-0 label">
                <span class="display-5" ref="observe">dsdotsen</span>
            </div>
            <div class="col burger m-0 pr-1">
                <burger-button
                    @open="openMenu"
                />
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
                  ua: 'Головна',
              }
            },

            active: false,
            animate: '',
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

        openMenu(active) {
            if(active){
                this.animate = 'show';
            }else{
                this.animate = 'hide'
            }
            setTimeout(() => {
                this.active = active

            }, 100)
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

.language {
    margin-top: 30px;
    opacity: 0.6;
    font-size: 20px;
}

.current_language {
    transition: 0.2s;
    color: orange;
}

.nav-menu {
    position: fixed;
    padding: 0;
    background: #ffffff;
    top: 0;
    left: 0;
}

.show {
    animation-name: show-nav;
    animation-duration: 0.5s;
}

.hide {
    animation-name: hide-nav;
    animation-duration: 0.5s;
}

.category {
    cursor: pointer;
    font-weight: lighter;
    font-size: 24px;
    padding: 30px 0px 0px 0px !important;
}

.subcategories {
    width: 100px;
    z-index: 999;
}

.subcategories a {
    font-size: 22px;
    font-weight: lighter;
}

.burger {
    position: fixed;
}

a {
    text-decoration: none;
    color: black;
}

.inst {
    opacity: 0.5;
    padding: 0px;
    margin-top: 30px;
}

@keyframes show-nav {
    0% {opacity: 0}
    100% {opacity: 1}
}

@keyframes hide-nav {
    0% {opacity: 1}
    100% {opacity: 0}
}
</style>
