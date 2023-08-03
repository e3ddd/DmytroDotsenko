<template>
        <Body_Desc
           class="desktop"
        />
        <Body_Mob
            class="mobile"
        />
</template>

<script>
import Body_Desc from "./Body_Desk.vue";
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
