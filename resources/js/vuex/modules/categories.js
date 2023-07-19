export default {
    state: {
        categories: [],
        parent_categories: [],
    },

    mutations: {
        setCategories(state, payload){
            state.categories = payload;
        },

        setParentCategories(state, payload) {
            state.parent_categories = payload
        },

        deleteCategory(state, payload) {
            state.categories = state.categories.filter(item => item.id != payload)
        }
    },

    getters: {
        getAllCategories(state){
            return state.categories;
        },

        getParentCategories(state) {
            return state.parent_categories
        },

    },

    actions: {
        getParentCategories(context) {
          axios.get('/api/get-parent-categories')
              .then(response => context.commit('setParentCategories', response.data))
        },

        getCategories(context){
            axios.get('/api/get-all-categories')
                .then(response => context.commit('setCategories', response.data)
                )
        },
    },

}
