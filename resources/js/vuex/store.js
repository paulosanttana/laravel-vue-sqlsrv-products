import Vue from 'vue'
import Vuex from 'vuex'

import Categories from './modules/categories/categories'
import preloader from './modules/preloader/preloader'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        categories: Categories,
        preloader: preloader
    }
})

export default store
