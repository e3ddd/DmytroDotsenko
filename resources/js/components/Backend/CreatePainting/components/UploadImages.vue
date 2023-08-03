<template>
    <div class="row mb-2">
        <div class="col p-0 d-flex justify-content-center align-items-center">
            <label class="upload-painting" for="upload-painting" style="padding: 100px;" v-if="this.files.length === 0">
                <span>Додати фотографію...</span>
            </label>
            <img v-if="this.files.length > 0" :src="this.files[0].url" alt="main-img" height="400">
        </div>
        <input type="file" id="upload-painting" @input="getImages" @change="onFileChange">
    </div>
    <div class="row ">
        <div class="col" style="max-width: 700px !important;;">
            <div class="row">
                <div class="col-4 mt-1 d-flex justify-content-center align-items-center" v-for="image in this.files">
                    <img :src="image.url" alt="image" height="100" @click="deleteImage" :id="image.id">
                </div>
                <div class="col-4 mt-1 d-flex justify-content-center align-items-center upload-image" v-if="this.files.length !== 0">
                    <label for="upload-painting">
                        +
                    </label>
                    <input type="file" id="upload-painting" @input="getImages" @change="onFileChange">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            files: [],
            imagesCount: 0
        }
    },

    methods: {
        getImages() {
            this.$emit('getImages', this.files)
        },

        deleteImage(e) {
            this.imagesCount--
            if(this.imagesCount === 0){
                this.imagesCount = 0
            }
            this.files = this.files.filter(item => item.id != e.target.id)

            this.$emit('deleteImage', e.target.id)
        },

        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            if(files[0].type == 'image/png' || files[0].type == 'image/jpeg'){
                this.files.push({id: this.imagesCount, file: files[0], url: URL.createObjectURL(files[0])})
                this.imagesCount++
            }
        }
    }

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
}

.upload-image {
    margin-top: 8px;
    height: 100px;
    border: 1px solid black;
    max-width: 150px;
}
</style>
