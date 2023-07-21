<template>
    <div class="container-fluid">
            <div class="row" v-if="this.active">
                <div class="col p-5 mt-4 nav-menu" :class="this.animate">
                    <div class="row" v-for="category in this.$store.getters.getAllCategories">
                       <div class="col-2 pb-3">
                           <div class="row">
                               <div class="col">
                                   <div class="row category" :id="category.id" @click="showSubcategories"  v-if="category.parent_id == null">
                                       {{category.name}}
                                   </div>
                                   <div class="row" v-for="subcategory in $store.getters.getSubcategories">
                                        {{subcategory}}
<!--                                       <router-link :to="'/' + subcategory[category.id].name">{{category.name}}</router-link>-->
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col p-5 label">
                <span class="display-5">dsdotsen</span>
            </div>
            <div class="col-8"></div>
            <div class="col burger">
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
            active: false,
            animate: '',
            show_sub: false,
        }
    },

    methods: {
        showSubcategories(e){
            if(!this.show_sub){
                this.$store.dispatch('getSubcategories', e.target.id)
                this.show_sub = true
            }
            this.show_sub = !this.show_sub
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
        }
    },

}
</script>

<style scoped>
.nav-menu {
    background: #ffffff;
    position: absolute;
    top: 0;
    left: 0;
}

.show {
    animation-name: show-nav;
    animation-duration: 0.5s;
}

.hide {
    animation-name: hide-nav;
    animation-duration: 0.1s;
}

tr {
    padding-bottom: 20px;
}



 .category {
     cursor: pointer;
    font-weight: lighter;
    font-size: 34px;
    padding: 50px 0px 0px 0px !important;
    z-index: 999;
}

.burger {
    position: fixed;
}

a {
    text-decoration: none;
    color: black;
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
