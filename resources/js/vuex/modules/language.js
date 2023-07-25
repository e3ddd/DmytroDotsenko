export default {
    state: {
        language: '',
    },

    mutations: {
        setLanguage(state, payload){
            state.language = payload;
        }
    },

    getters: {
        getLanguage(state){
            return state.language;
        }
    },

    actions: {
        setDefaultLanguage(context) {
            context.commit('setLanguage', 'ua')
        }
    }
}
