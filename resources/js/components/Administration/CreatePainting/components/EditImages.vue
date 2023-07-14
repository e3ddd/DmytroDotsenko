<template>
    <div class="row">
        <div class="col-4 p-3 d-flex justify-content-center align-items-center" v-for="image in images" :key="image.id">
            <div class="row">
                <div class="col-11">
                    <img :src="'/storage/images/' + image.painting_id + '_' + image.hash_id" alt="image" height="300">
                </div>
                <div class="col p-0 cross" @click="this.$emit('deleteImage', image.id)">
                    X
                </div>
            </div>
        </div>
        <div class="col-4 upload-image d-flex justify-content-center align-items-center">
            <label for="upload-painting" style="font-size: 40px">
                +
            </label>
            <input type="file" id="upload-painting" @change="onFileChange">
        </div>
    </div>

</template>

<script>
export default {
    props: {
        images: Array
    },

    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            if (files[0].type == 'image/png' || files[0].type == 'image/jpeg') {
                let image = {file: files[0], url: URL.createObjectURL(files[0])}
                this.$emit('updateImage', image)
            }
        }
    },
}
</script>

<style scoped>

#upload-painting {
    opacity: 0;
    position: absolute;
    z-index: -1;
}

label {
    cursor: pointer;
}

label:hover {
    color: white;
    transition: 0.2s;
}

.cross {
    cursor: pointer;
}

.cross:hover {
    color: white;
    transition: 0.2s;
}

.upload-image {
    padding-top: 200px;
    padding-bottom: 200px;
}
</style>
