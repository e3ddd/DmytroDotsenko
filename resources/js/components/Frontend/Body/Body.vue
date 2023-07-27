<template>
        <Body_Desc
            v-if="this.width > 981"
        />
        <Body_Mob
            v-if="this.width <= 981"
        />
</template>

<script>
import Body_Desc from "./Body_Desc.vue";
import Body_Mob from "./Body_Mob.vue";

export default {
    components: {Body_Mob, Body_Desc},
    data: () =>({
        width: '',
    }),

    mounted() {
        this.$store.dispatch('getAllPaintings');
        this.width = window.innerWidth;
    }
}
</script>

<style scoped>

</style>
