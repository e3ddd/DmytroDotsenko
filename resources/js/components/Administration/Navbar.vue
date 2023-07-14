<template>
    <div class="container nav-bar">
        <div class="row">
            <div class="col p-3 links">
                <div class="row">
                    <div class="col mt-2 link">
                        <router-link to="/admin/categories">Список категорій</router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2 link">
                        <router-link to="/admin/create">Додати роботу</router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2 link">
                        <router-link to="/admin/catalog" >Каталог</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>

a {
    text-decoration: none;
    color: #000;
    font-size: 14px;
    text-transform: uppercase;
}

a:hover {
    transition: 0.5s;
    color: #fff;
}

.nav-bar {
    height: 100%;
    background-color: #64a0c2;
}
</style>
