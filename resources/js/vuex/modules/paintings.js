export default {
    state: {
        paintings: [],
        total: 0,
    },

    getters: {
        getAllPaintings(state){
            return state.paintings;
        },

        getTotalValue(state) {
            return state.total;
        },
    },

    mutations: {
        setPaintings(state, payload) {
            state.paintings = payload;
        },

        setTotalValue(state, payload) {
            state.total = payload;
        },

    },

    actions: {
      getPaintings(context, payload){
          axios.get('/api/get-all-painting-with-pagination?page=' + payload)
              .then((response) => {
                    context.commit('setPaintings', response.data.data);
                    context.commit('setTotalValue',  Math.ceil(response.data.total / response.data.per_page));
              })
              .catch(err => console.log(err))
      }
    },
}
