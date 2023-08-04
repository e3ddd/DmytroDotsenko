export default {
    state: {
        current_category: [],
        categories: [],
        parent_categories: [],
        subcategories: [],
    },

    mutations: {
        setCategories(state, payload){
           state.categories = payload
        },

        setSubcategories(state, payload) {
          state.subcategories = payload
        },

        setParentCategories(state, payload) {
            state.parent_categories = payload
        },

        setCurrentCategory(state, payload) {
            state.current_category = payload
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
            return state.parent_categories;
        },

        getSubcategories(state) {
            return state.subcategories;
        },

        getCategoryById(state){
            return state.current_category;
        },
    },

    actions: {
        getParentCategories(context) {
          axios.get('/api/get-parent-categories')
              .then(response => context.commit('setParentCategories', response.data))
              .catch(err => console.log(err))
        },

        getCategoryById(context, payload) {
          axios.get('/api/get-category-by-id', {
              params: {
                  category_id: payload
              }
          })
              .then(response => context.commit('setCurrentCategory', response.data))
              .catch(err => console.log(err))
        },

        getCategories(context){
            axios.get('/api/get-all-categories')
                .then(response => context.commit('setCategories', response.data))
                .catch(err => console.log(err))
        },

        getSubcategories(context, payload) {
            axios.get('/api/get-subcategories', {
                params: {
                    parent_id: payload.parent_id
                }
            })
                .then(response => {
                    context.commit('setSubcategories', response.data)
                })
                .catch(err => console.log(err))
        }

    },

}
