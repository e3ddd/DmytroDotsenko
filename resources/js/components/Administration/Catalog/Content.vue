<template>
    <div class="row">
        <div class="col d-flex justify-content-end">
           <div class="row">
               <div class="col-1">
                   <router-link :to="'/admin/edit/' + painting.id">
                       <img src="../../../images/edit-btn.png" width="20" alt="edit">
                   </router-link>
               </div>
               <div class="col-1">
                   <img src="../../../images/view-btn.png" alt="view" width="20">
               </div>
               <div class="col-1">
                   <img src="../../../images/delete-btn.png" alt="delete" width="20">
               </div>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Назва
        </div>
        <div class="col">
            {{painting.name}}
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
            Опис
        </div>
        <div class="col">
            {{painting.description}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            Розмір
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    {{painting.width}}x{{painting.height}}x{{painting.long}}
                </div>
            </div>
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
</template>

<script>
import ContentBtns from "../Buttons/ContentBtns.vue";
export default {
    components: {
        ContentBtns,
    },
    props: {
        painting: [Array, Object],
    }
}
</script>

<style scoped>

</style>
