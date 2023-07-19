export default {
    state: {
        loading: false,
    },

    mutations: {
        setLoadingState(state, payload) {
            return state.loading = payload
        }
    },

    getters: {
        getLoadingState(state) {
            return state.loading;
        },
    }
}
