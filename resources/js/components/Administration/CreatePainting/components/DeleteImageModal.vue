<template>
    <div class="attention_modal" v-if="show" @click="this.$emit('show', show = !show)">
        <div @click.stop class="attention_item">
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <h5>
                        Видалити зображення ?
                    </h5>
                </div>
            </div>
            <div class="row btns">
                <div class="col-3"></div>
                <div class="col-4 agree btns" @click="del">
                    Так
                </div>
                <div class="col-4 disagree btns" @click="this.$emit('show', show = !show)">
                     Ні
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: Boolean,
        image_id: Number,
    },

    data() {
        return {
        }
    },

    methods: {
       async del() {
           axios.post('/api/delete-painting-image', {
               image_id: this.image_id
           })
               .catch(err => console.log(err))

           this.$emit('show', !this.show)
       }
    }
}
</script>

<style scoped>
a {
    text-decoration: none;
    color: black;
}

.btns {
    cursor: pointer;
}

.a:hover {
    color: #fe3939;
    font-size: 18px;
    transition: 0.2s;
}

.disagree:hover {
    font-size: 18px;
    transition: 0.2s;
}

.attention_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.attention_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}


</style>
