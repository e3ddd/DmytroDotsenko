<template>
    <button @click="func(par)"><slot></slot></button>
</template>

<script>
export default {
    props: {
        func: Function,
        par: [String, Number, Array],
    }
}
</script>

<style scoped>

</style>
