<template>
    <div class="row">
        <div class="col-2">
            Назва
        </div>
        <div class="col">
            {{painting.name}}
        </div>
        <div class="col">

        </div>
    </div>
    <div class="row">
        <div class="col-2">
            Ціна
        </div>
        <div class="col">
            {{painting.price}} $
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            Рік
        </div>
        <div class="col">
            {{painting.year}} рік
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            Опис
        </div>
        <div class="col">
            {{painting.description}}
        </div>
    </div>
    <div class="row">
        <div class="col-2">
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
        <div class="col-2">
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
