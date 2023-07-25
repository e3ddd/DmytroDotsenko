<template>
    <div class="buy-modal">
        <div @click.stop class="buy-modal-item">
            <div class="row">
                <div class="col d-flex justify-content-end align-items-end" style="font-size: 20px" @click="this.$emit('show', false)">
                    X
                </div>
            </div>
                <div class="row">
                    <div class="col p-3">
                        <span>{{this.title[$store.getters.getLanguage]}}</span>
                    </div>
                </div>
            <div class="row">
                <div class="col">
                    <input type="text" placeholder="example@gamil.com" v-model="this.email">
                </div>
                <div class="col">
                    <button @click="send">{{this.buy_btn[$store.getters.getLanguage]}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data: () => ({
        email: '',
        title: {
            en: 'Leave your e-mail address for communication.',
            ua: 'Залиште свою електрону адресу для зв\'язку.'
        },
        buy_btn: {
            en: 'Buy',
            ua: 'Купити'
        }
    }),

    methods: {
      async send() {
          axios.post()
      }
    },
}
</script>

<style scoped>
input {
    padding: 10px;
}

button {
    background: #302f2f;
    color: white;
    padding: 10px;
    font-style: italic;
}

.buy-modal {
    font-style: italic;
    font-size: 32px;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
    z-index: 100;
}

.buy-modal-item {
    padding: 30px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

</style>
