export default {
    state: {
        links: {}
    },

    getters: {
        getLinks(state) {
            return state.links;
        }
    },

    mutations: {
        setLinks(state, payload){
            state.links = payload;
        }
    },

    actions: {
      getLinks(context, payload){

      }
    },
}
