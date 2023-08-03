<template>
    <PaintingPage_Desk
        class="desktop"
    />

    <PaintingPage_Mob
        class="mobile"
    />
</template>

<script>
import PaintingPage_Desk from "./PaintingPage_Desk.vue";
import PaintingPage_Mob from "./PaintingPage_Mob.vue";

export default {
    components: {
        PaintingPage_Desk,
        PaintingPage_Mob,
    },

    mounted() {
        this.$store.dispatch('getPaintingBySlug', {
            slug: this.$route.params.painting_slug
        })
    }

}
</script>

<style scoped>
.mobile {
    display: none;
}
</style>
