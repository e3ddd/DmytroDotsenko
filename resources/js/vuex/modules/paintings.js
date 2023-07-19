export default {
    state: {
        paintings: []
    },

    getters: {
        getAllPaintings(state){
            return state.paintings;
        }
    },

    mutations: {
        setPaintings(state, payload) {
            state.paintings = payload;
        }
    },

    actions: {
      getPaintings(context, payload){
          axios.get('/api/get-all-painting-with-pagination?page=' + payload)
              .then(response => context.commit('setPaintings', response.data.data))
              .catch(err => console.log(err))
      }
    },
}
