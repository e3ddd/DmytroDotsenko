<template>
    <div class="row alert_message">
        <div class="col error" v-if="$store.getters.getMessage.type === 'error'">
            {{$store.getters.getMessage.content}}
        </div>
        <div class="col success" v-if="$store.getters.getMessage.type === 'success'">
            {{$store.getters.getMessage.content}}
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.alert_message {
    position: fixed;
    z-index: 99;
    left: 47%;
    top: -1px;
    color: #ffffff;
    font-size: 14px;
    width: 300px !important;
    height: 60px;
}

.error {
    background: #fe3939;
}

.success {
    background: #00ba0c;
}
</style>
