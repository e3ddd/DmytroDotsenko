<template>
    <div class="row">
        <div class="col" v-for="image in images" :key="image.id">
            <div class="row">
                <div class="col-11">
                        <background-image
                            :path="'/storage/images/' + image.painting_id + '_' + image.hash_id"
                        />
                </div>
                <div class="col p-0 cross">
                    <span @click="this.$emit('deleteImage', image.id)">X</span>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <label for="upload-painting" style="font-size: 40px">
                +
            </label>
            <input type="file" id="upload-painting" @change="onFileChange">
        </div>
    </div>

</template>

<script>
import BackgroundImage from "../../../UI/BackgroundImage.vue";
import DeleteImageModal from "./DeleteImageModal.vue";
export default {
    components: {
        DeleteImageModal,
        BackgroundImage,
    },

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
        },
    },
}
</script>

<style scoped>

.photoBorder {
    margin-top: 20px;
    width: 500px;
    height: 500px;

    background-repeat     : no-repeat;
    background-size       : contain;
    background-position-x : 50%;
    background-position-y : 50%;
}

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


.cross span:hover {
    cursor: pointer;
    color: white;
    transition: 0.2s;
}

.upload-btn {
    padding: 100px;
}

</style>
