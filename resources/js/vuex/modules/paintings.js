export default {
    state: {
        paintings: [],
        total: 0,
        current_painting: [],
    },

    getters: {
        getAllPaintings(state){
            return state.paintings;
        },

        getTotalValue(state) {
            return state.total;
        },

        getPaintingByCategorySlug(state){
          return state.paintings
        },

        getCurrentPainting(state) {
            return state.current_painting;
        }
    },

    mutations: {
        setPaintings(state, payload) {
            state.paintings = payload;
        },

        setTotalValue(state, payload) {
            state.total = payload;
        },

        setCurrentPainting(state, payload){
            state.current_painting = payload
        }
    },

    actions: {
        getPaintings(context, payload){
          axios.get('/api/get-all-paintings-with-pagination?page=' + payload)
              .then((response) => {
                    context.commit('setPaintings', response.data.data);
                    context.commit('setTotalValue',  Math.ceil(response.data.total / response.data.per_page));
              })
              .catch(err => console.log(err))
        },

        getAllPaintings(context){
            axios.get('/api/get-all-paintings')
                .then(response => {
                    context.commit('setPaintings', response.data)
                })
                .catch(err => console.log(err))
        },

        getPaintingBySlug(context, payload){
            axios.get('/api/get-painting-by-slug', {
                params: {
                    slug: payload.slug
                }
            })
                .then(response => {
                    context.commit('setCurrentPainting', response.data[0])
                })
                .catch(err => console.log(err))
        },

        getPaintingByCategorySlug(context, payload) {
            axios.get('/api/get-painting-by-category-slug', {
                params: {
                    category_slug: payload
                }
            })
                .then((response) => {
                    context.commit('setPaintings', response.data)
                })
                .catch(err => console.log(err))
        }
    },
}
