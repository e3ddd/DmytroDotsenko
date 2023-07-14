<template>
    <div class="row alert_message">
        <div class="col error" v-if="type === 'error'">
            {{content}}
        </div>
        <div class="col success" v-if="type === 'success'">
            {{content}}
        </div>
    </div>
</template>

<script>
export default {
   props: {
       type: String,
       content: String,
   }
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
