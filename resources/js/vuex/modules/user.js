export default {
    state: {
        admin: ''
    },

    mutations: {
        setAdmin(state, payload){
            state.admin = payload
        }
    },

    getters: {
        getAdmin(state){
            return state.admin
        }
    },

}
