<template>
    <div class="container-fluid panel">
        <div class="row head">
            <div class="col pt-2">
                <span>Dmytro Dotsenko</span>
            </div>
        </div>
        <div class="row">
            <div class="col-2 p-0">
               <navbar/>
            </div>
            <div class="col-xxl">
                <component :is="currentView"/>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
import Catalog from "./Catalog/Catalog.vue";
import CreatePainting from "./CreatePainting/CreatePainting.vue";

const routes = {
    '/catalog': Catalog,
    '/create': CreatePainting,
}
export default {
    components: {
        Navbar
    },

    data() {
        return {
            currentPath: window.location.hash
        }
    },
    computed: {
        currentView() {
            return routes[this.currentPath.slice(1) || '/']
        }
    },
    mounted() {
        window.addEventListener('hashchange', () => {
            this.currentPath = window.location.hash
        })
    }

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
    background-color: #a3adb2;
    width: 1200px;
    height: 100%;
    opacity: 0.75;
}

</style>
