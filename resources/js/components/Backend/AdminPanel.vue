<template>
    <div class="container-fluid page">
        <div class="row head">
            <div class="col pt-2">
                <span>Dmytro Dotsenko</span>
            </div>
        </div>
        <div class="row panel">
            <div class="col p-0 nav-bar">
               <navbar/>
            </div>
            <div class="col-10 content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";

export default {
    components: {
        Navbar
    },
}
</script>

<style scoped>

.page {
    height: 100%;
}

.head span {
    color: #fff;
    margin: 0;
}

.head {
    height: 40px;
    background: #43846b;
}

.panel {
    min-height: 100%;
    background-color: #d3d3d3;
}

.nav-bar {
    height: 100vh;
}


</style>
