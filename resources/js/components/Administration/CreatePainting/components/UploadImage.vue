<template>
    <div class="row mb-2 upload-painting">
        <label for="upload-painting">

            <span>Добавити фотографію...</span>

        </label>
        <input type="file" id="upload-painting">
    </div>
    <div class="row">

    </div>
</template>

<script>
export default {

}
</script>

<style scoped>

label {
    cursor: pointer;
}

#upload-painting {
    opacity: 0;
    position: absolute;
    z-index: -1;
}

.upload-painting {
    cursor: pointer;
    border: 1px solid black;
    padding: 100px;
}
</style>
