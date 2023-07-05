<template>
    <div class="container">
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
                                    <my-button
                                        :func="login"
                                    >Вхід
                                    </my-button>
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
export default {
    components: {
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
            const response = axios.get('/administration/login/log', {
                params: {
                    email: this.email,
                    password: this.password
                }
            }).then((response) => {
                    if(response.data){
                        location.replace('/administration')
                    }
                })
                .catch((err) => {
                console.log(err)
                this.errors = err
            })
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
