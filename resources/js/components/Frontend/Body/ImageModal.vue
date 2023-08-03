<template>
    <div class="image-modal">
        <div class="btn-close-image-modal" @click="this.$emit('show', false)">
            X
        </div>
        <div @click.stop class="image-modal-item">
            <div class="row">
                <div class="col">
                    <img :src="'/storage/images/' + $store.getters.getCurrentImage[0].painting_id + '_' + $store.getters.getCurrentImage[0].hash_id" alt=""
                         :width="$store.getters.getCurrentImage[0].width / 4"
                         :height="$store.getters.getCurrentImage[0].height / 4"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BackgroundImage from "../../UI/BackgroundImage.vue";

export default {
    components: {BackgroundImage}

}
</script>

<style scoped>
.btn-close-image-modal {
    right: 70px;
    top: 30px;
    color: white;
    padding: 10px 20px 10px 20px;
    background: black;
    cursor: pointer;
    position: absolute;
}

.image-modal {
    overflow: auto;
    font-size: 20px;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: white;
    position: fixed;
    display: flex;
    z-index: 100;
}

.image-modal-item {
    padding: 10px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}
</style>
