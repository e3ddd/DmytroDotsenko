<template>
    <alert-messages/>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col form">
                    <div class="row header">
                        <p>Вхід</p>
                    </div>
                    <div class="underline"></div>
                    <div class="row">
                        <div class="col inputs">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <label for="email">Логін</label>
                                    </div>
                                    <div class="row">
                                        <my-input
                                            id="email"
                                            :name="'email'"
                                            :type="'email'"
                                            v-model="this.email"
                                            @update="onUpdateEmail"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <label for="password">Пароль</label>
                                    </div>
                                    <div class="row">
                                        <my-input
                                            id="password"
                                            :name="'password'"
                                            :type="'password'"
                                            v-model="this.password"
                                            @update="onUpdatePassword"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col enter-btn">
                                    <button @click="login">Вхід</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import MyInput from "../UI/MyInput.vue";
import MyButton from "../UI/MyButton.vue";
import router from "../../routers/router";
import AlertMessages from "../UI/AlertMessages.vue";
export default {
    components: {
        AlertMessages,
        MyInput,
        MyButton
    },

    data() {
        return {
            email: '',
            password: '',
            errors: ''
        }
    },

    methods: {
       async login() {
            this.$store.dispatch('login', {
                email: this.email,
                password: this.password,
            })

           setTimeout(() => {
               if(this.$store.getters.getError !== ''){
                   this.$store.commit('setMessage', {
                       type: 'error',
                       content: this.$store.getters.getError
                   })

                   setTimeout(() => {
                       this.$store.commit('setMessage', {
                           type: '',
                           content: ''
                       })
                   }, 3000)
               }

               if(this.$store.getters.getAdmin){
                   router.replace('/admin')
               }
           },200)


        },


        onUpdateEmail(email) {
            this.email = email
        },

        onUpdatePassword(password) {
            this.password = password
        }
    }
}
</script>

<style scoped>

.header {
    font-size: 16px;
    margin-left: 5px;
}

.underline {
    padding: 0;
    border-bottom: 1px solid black;
}

.form {
    border-radius: 10px;
    font-size: 14px;
    border: 2px solid black;
    width: 300px;
    height: 200px;
}

.inputs {
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 10px;
    text-align: center;
}

.enter-btn {
    padding: 3px;
    margin-top: 7px;
    margin-right: 55px;
    text-align: end;
}

</style>
