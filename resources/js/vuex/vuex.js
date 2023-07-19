import {createStore} from "vuex";

import loader from "./modules/loader.js";
import alert_messages from "./modules/alert-messages.js";
import categories from './modules/categories.js'
import paintings from "./modules/paintings.js";

const vuex = createStore({
    modules: {
        loader,
        alert_messages,
        categories,
        paintings,
    }
})

export default vuex;
