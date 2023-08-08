export default {
    state: {
        paintings: [],
        total: 0,
        current_painting: [],
        current_image: [],
    },

    getters: {
        getAllPaintings(state){
            return state.paintings;
        },

        getTotalValue(state) {
            return state.total;
        },

        getCurrentPainting(state) {
            return state.current_painting;
        },

        getCurrentImage(state) {
            return state.current_image;
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
        },

        filterPaintings(state, payload){
            state.paintings = state.paintings.filter((item, key) => {
                 return key !== payload
            })
        },

        setCurrentImage(state, payload) {
            state.current_image = state.current_painting.images.filter((item) => {
                return item.id == payload;
            })
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
                    category_slug: payload.category_slug,
                    subcategory_slug: payload.subcategory_slug,
                }
            })
                .then((response) => {
                    context.commit('setPaintings', response.data)
                })
                .catch(err => console.log(err))
        }
    },
}
