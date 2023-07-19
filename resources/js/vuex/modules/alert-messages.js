export default {
    state: {
        message: {
            type: '',
            content: '',
        }
    },

    mutations: {
        setMessage(state, payload){
            state.message.type = payload.type
            state.message.content = payload.content
        },
    },

    getters: {
      getMessage(state){
          return state.message;
      }
    },

}
