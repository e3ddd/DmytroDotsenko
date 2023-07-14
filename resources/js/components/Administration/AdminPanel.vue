<template>
    <div class="container-fluid panel">
        <div class="row head">
            <div class="col pt-2">
                <span>Dmytro Dotsenko</span>
            </div>
        </div>
        <div class="row">
            <div class="col p-0 nav-bar">
               <navbar/>
            </div>
            <div class="col-10">
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

.head span {
    color: #fff;
    margin: 0;
}

.head {
    height: 40px;
    background: #43846b;
}

.panel {
    background-color: #d3d3d3;
    min-height: 100%;
}
</style>
