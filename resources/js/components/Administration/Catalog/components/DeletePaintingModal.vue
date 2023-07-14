<template>
    <div class="delete_modal" @click="this.$emit('show', false)">
        <div @click.stop class="delete_item">
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <h5>
                        Видалити роботу "{{name}}" ?
                    </h5>
                </div>
            </div>
            <div class="row btns">
                <div class="col-3"></div>
                <div class="col-4 agree btns" @click="deletePainting">
                    Так
                </div>
                <div class="col-4 disagree btns" @click="this.$emit('show', false)">
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
        name: String,
        painting_id: Number,
    },

    methods: {
        async deletePainting(){
            axios.post('/api/delete-painting', {
                paintingId: this.painting_id
            })
                .catch(err => console.log(err))
                .finally(() => {
                    location.reload()
                })
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

.agree:hover {
    color: red;
    transition: 0.2s;
    font-size: 18px;
}

.disagree:hover {
    font-size: 18px;
    transition: 0.2s;
}

.delete_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
    z-index: 100;
}

.delete_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}


</style>
