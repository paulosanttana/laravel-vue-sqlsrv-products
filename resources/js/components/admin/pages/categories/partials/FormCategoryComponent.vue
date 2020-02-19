<template>
    <div>
        
        <form class="form" @submit.prevent="onSubmit">
            <div :class="['form-group', {'has-error': errors.name}]">
                <div v-if="errors.name">{{ errors.name[0] }}</div>
                <input type="text" v-model="category.name" class="form-control" placeholder="Nome da Categoria">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        category: {
            require: false,
            type: Object|Array,
            default: () => {
                return {
                    id: '',
                    name: '',
                }
            }
        },
        updating: {
            require: false, //NÃO OBRIGATÓRIO
            type: Boolean,
            default: false, // NÃO FAZ UPDATE
        }
    },
    data () {
        return {
            errors: {}
        }
    },
    methods: {
        // Passa a responsabilidade de cadastro para Vuex 'categories.js'
        onSubmit () {
            const action = this.updating ? 'updateCategory' : 'storeCategory'

            this.$store.dispatch(action, this.category)
                            .then(() => {
                                this.$snotify.success('Sucesso ao cadastrar')

                                this.$router.push({name: 'admin.categories'})
                            })
                            .catch(error => {   
                                this.$snotify.error('Algo deu errado', 'Erro')
                                
                                console.log(error.response.data.errors)
                                this.errors = error.response.data.errors
                            })
        }
    }

}
</script>

<style scoped>
.has-error {color: red;}
.has-error input{border: 1px solid red;}
</style>