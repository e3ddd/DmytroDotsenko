import {createStore} from "vuex";

import loader from "./modules/loader.js";
import alert_messages from "./modules/alert-messages.js";
import categories from './modules/categories.js'
import paintings from "./modules/paintings.js";
import share_links from './modules/share-links.js';
import language from './modules/language.js';
import user from "./modules/user";

const vuex = createStore({
    modules: {
        loader,
        alert_messages,
        categories,
        paintings,
        share_links,
        language,
        user
    }
})

export default vuex;
