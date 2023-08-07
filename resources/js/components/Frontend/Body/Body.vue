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
}
</script>

<style scoped>
.desktop {
    opacity: 0;
    animation: ani 1s forwards;
}

@keyframes ani {
    0% {opacity: 0;}
    100% {opacity: 1;}
}
</style>
