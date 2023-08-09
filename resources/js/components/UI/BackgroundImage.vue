<template>
    <div :style="{
                     'background-image': 'url(' + path + ')',
                    }" class="photoBorder">
    </div>
</template>

<script>
export default {
    props: {
        path: String
    }
}
</script>

<style scoped>
.photoBorder {
    margin-top: 20px;
    width: 100%;
    height: 50vh;

    background-repeat     : no-repeat;
    background-size       : contain;
    background-position-x : 50%;
    background-position-y : 50%;
}
</style>
