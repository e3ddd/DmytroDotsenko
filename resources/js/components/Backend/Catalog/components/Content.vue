<template>
    <delete-painting-modal
        :painting_id="painting.id"
        :name="painting.name_ua"
        v-if="this.show"
        @show="showModal"
    />
    <div class="row">
        <div class="col d-flex justify-content-end">
           <div class="row">
               <div class="col-1">
                   <router-link :to="'/admin/edit/' + painting.id">
                       <img src="../../../../images/edit-btn.png" width="20" alt="edit">
                   </router-link>
               </div>
               <div class="col-1">
                   <img @click="this.show = true" :id="painting.id" src="../../../../images/delete-btn.png" alt="delete" width="20">
               </div>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Категорія
        </div>
        <div class="col">
            {{this.$store.getters.getCategoryById.name_ua}}
            /
            {{this.subcategory.name_ua}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Слаг
        </div>
        <div class="col">
            {{painting.slug}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Назва
        </div>
        <div class="col">
            {{painting.name_ua}}
        </div>
        <div class="col">

        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Ціна
        </div>
        <div class="col">
            {{painting.price}} $
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Рік
        </div>
        <div class="col">
            {{painting.year}} рік
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Матеріал
        </div>
        <div class="col">
            {{painting.material_ua}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Техніка
        </div>
        <div class="col">
            {{painting.style_ua}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Розмір
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    {{painting.height}}x{{painting.long}} см
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Порядок відображення
        </div>
        <div class="col">
            {{painting.order}}
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            Продана
        </div>
        <div class="col" v-if="painting.sold_status === 0">
            Ні
        </div>
        <div class="col" v-if="painting.sold_status === 1">
            Так
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            Опис
        </div>
        <div class="col">
            {{painting.description_ua}}
        </div>
    </div>
</template>

<script>
import DeletePaintingModal from "./DeletePaintingModal.vue";
import ContentBtns from "../../Buttons/ContentBtns.vue";
import {mapGetters} from "vuex";
export default {
    components: {
        ContentBtns,
        DeletePaintingModal,
    },

    mounted() {
        setTimeout(() => {
          this.$store.dispatch('getCategoryById', this.painting.category_id)
      }, 100)


        setTimeout(() => {
            this.subcategory = this.$store.getters.getCategoryById
            this.$store.dispatch('getCategoryById', this.subcategory.parent_id)
      }, 200)
    },

    data() {
        return {
            show: false,
            subcategory: {},
            category: {}
        }
    },

    computed: {
        categories() {
            return {
                parent: this.$store.getters.getCategoryById,
            }
        }
    },

    methods: {
        showModal(show){
            this.show = show
        }
    },

    props: {
        painting: [Array, Object],
    }
}
</script>

<style scoped>

</style>
