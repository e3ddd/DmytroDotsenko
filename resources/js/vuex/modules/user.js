export default {
    state: {
        login: false,
        admin: false,
        error: '',
    },

    mutations: {
        setAdmin(state, payload){
            state.admin = payload
        },

        setError(state, payload){
            state.error = payload
        },

        setLogin(state, payload){
            state.login = payload
        }
    },

    getters: {
        getAdmin(state){
            return state.admin
        },

        getError(state) {
            return state.error
        },

        getLogin(state){
            return state.login
        }
    },

    actions: {
        login(context, payload) {
            axios.post('/api/login/log', {
                    email: payload.email,
                    password: payload.password,
            })
                .then((response) => {
                    context.commit('setAdmin', response.data);
                })
                .catch(err => context.commit('setError', err.response.data.message))
        },

        checkLogin(context) {
            axios.post('/api/check-login')
                .then((response) => {
                    context.commit('setLogin', true);
                })
                .catch((err) => {
                    context.commit('setLogin', false);
                })
        }
    }

}
