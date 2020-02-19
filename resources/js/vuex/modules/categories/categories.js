export default {
    state: {
        items: {
            data: []
        },
    },
    mutations: {
        LOAD_CATEGORIES (state, categories) {
            state.items = categories
        }
    }, 
    actions: {
        loadCategories (context, params) {
            context.commit('PRELOADER', true)

            axios.get('/api/v1/categories', {params})
                    .then(response => {
                        console.log(response)

                        context.commit('LOAD_CATEGORIES', response)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
                    .finally(() => context.commit('PRELOADER', false))
        },


        loadCategory (context, id) {
            context.commit('PRELOADER', true)

            return new Promise ((resolve, reject) => {
                axios.get(`/api/v1/categories/${id}`)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))            
            })
        },


        storeCategory (context, params) {
            context.commit('PRELOADER', true)

            return new Promise ((resolve, reject) => {
                axios.post('/api/v1/categories', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))            
            })
        },


        updateCategory (context, params) {
            context.commit('PRELOADER', true)

            return new Promise ((resolve, reject) => {
                axios.put(`/api/v1/categories/${params.id}`, params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))            
            })
        },


        destroyCategory (context, id) {
            context.commit('PRELOADER', true)

            return new Promise ((resolve, reject) => {
                axios.delete(`/api/v1/categories/${id}`)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    // .finally(() => context.commit('PRELOADER', false))            
            })
        },



    },
    getters: {
        
    }
}