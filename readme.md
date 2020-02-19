
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<br>

**Projeto Laravel + VueJs + SQLServer. Cadastrando Produtos**

Consumindo API Laravel, SQL Server e VueJs. Esse projeto utiliza Laravel 5.7, VueJs, Bootstrap e Mysql.




**Contents**

- [Configuração SQL Server](#Configuração-SQL-Server)
- [Install](#Install)
- [Ativar VueJs](#Ativar-VueJs)
- [Criando component](#Criando-component)
- [Configurando view routers](#Configurando-view-routers)
- [Configurando Vuex](#Configurando-Vuex)
- [BrowserSync](#BrowserSync)
- [Administrando Categorias](#Administrando-Categorias)



## Configuração SQL Server

**Driver SQLSERVER para PHP**

1. Acesse o site e faça o download do driver `Microsoft Drivers 5.8 for PHP for SQL Server`
[Link Driver](https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2017)

2. Extraia os drivers para o diretório `ext` da instalação do PHP

3. Adicionar no `php.ini` as extençõs
```bash
extension=php_sqlsrv_73_nts_x64.dll
extension=php_pdo_sqlsrv_73_nts_x64.dll
```

**Arquivo config\database.php**
```php
'default' => env('DB_CONNECTION', 'sqlsrv'),
	
	...
	
'sqlsrv' => [
	'driver' => 'sqlsrv',
	'url' => env('DATABASE_URL'),
	'host' => env('DB_HOST', 'DESKTOP-890UMAI'),  //Adicionado nome do servidor
	'port' => env('DB_PORT', '1433'),
	'database' => env('DB_DATABASE', 'forge'),
	'username' => env('DB_USERNAME', 'forge'),
	'password' => env('DB_PASSWORD', ''),
	'charset' => 'utf8',
	'prefix' => '',
	'prefix_indexes' => true,
],
```

**Arquivo .env**
```txt
DB_CONNECTION=sqlsrv
DB_HOST="DESKTOP-890UMAI"  
DB_PORT=null
DB_DATABASE=LARAVEL_VUE
DB_USERNAME=sa
DB_PASSWORD=sql@2020
```

**Solução para o erro “Tipo de dados datetime resultou em um valor fora do intervalo” no SQL Server**

(Executar no SQL Server)

Exec sp_defaultlanguage 'sa', 'us_english'
Reconfigure

-------------------------------------------------------

**Install**

1. Instalação das dependencias do `package.json`. Para isso o NodeJs tem que esta instalado!
```bash
npm install
```

2. Instalação dos pacotes `vue-router` (gerencia rotas) e `Vuex` (gerencia os estados da aplicação).
```bash
npm install --save-dev vue-router vuex
```

3. Configuração Laravel Mix para fazer a compilação dos códigos
```php
// webpack.mix.js
```

**Comandos Dev/Prod**

Comando para criar arquivo .js e .scc não minificado quando for ambiente desenvolvimento
```bash
npm run dev
```

Comando para criar arquivo .js e .scc  minificado quando for ambiente produção
```bash
npm run prod
```

Estrutura do VueJs fica dentro de `resource\assets\js`


## Ativar VueJs

4. Adicione no arquivo `welcome.blade.php` o seletor id `app` e link ao `/js/app.js` usando o helper do Laravel Mix, pode usar o helper `url()` ou `assets()` também se quiser.
```php
// resources\views\welcome.blade.php

<body>
        <div id="app" class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    ...
```

```php
// resources\views\welcome.blade.php

    ...

    <script src="{{ mix('/js/app.js') }}"></script> // Adicionado
    </body>
</html>
```

Adicione ao `heard` a tag `<meta>` passando o `csrf_token` para não aparecer mensam de erro csrf.
```php
// resources\views\welcome.blade.php

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">  // Adicionado

<!-- Styles -->
<style>
    ...
```

## Criando component

**Trabalhado Vue com Laravel**

Uma das formar e criar componente e incluir na view do laravel.

5. Crie component `TestComponent.vue` e adicione o código
```php
// resources\js\component

<template>
    <div>
        <h1>Sou um component vue JS =D</h1>
    </div>
</template>


<script>
export default {
    // scripts javascript
}
</script>


<style scoped>
    /* CSS */
</style>
``` 

5.1 Declare o component
```php
// resources\js\app.js

require('./bootstrap');
window.Vue = require('vue');


import router from './routes/routers'   // importado component


/***
 * Components globais
 */
Vue.component('test-component', require('./components/TestComponent').default)  // Declara component

const app = new Vue({
```


*sempre após editar, compilar `npm run dev`*


## Configurando view routers 

6. Cria pasta `routes` dentro do diretório `resources\assets\js` e dentro do novo diretório adicione arquivo `routers.js` com o código abaixo:
```javascript
import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

const routes = [
    // Todas Rotas

]

const router = new VueRouter({
    routes
})


export default router
``` 

## Configurando Vuex

7. Crie diretório `vuex` e dentro adicione arquivo `store.js`.

> resource\js\vuex\store.js

7.1 Adicione o código no `store.js`
```javascript
import Vue from 'vue'
import Vuex from 'vuex'

import Categories from './modules/categories/categories'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        categories: Categories
    }
})

export default store
```

## BrowserSync

>Rodar o browserSync é opcional, pois ele irá atualizar o browser automaticamente o que facilita o desenvolvimento da aplicação. Porém se não quiser pode continuar usando o `npm run dev` para compilar a aplicação toda vez que realizar atualização e atualizar o browser manualmente `F5`.

>No procedimento abaixo iremos rodar o `npm run watch`, através dele será executado a compilação da aplicação e atualizar o browser automaticamente .

8. Configurar browser mix no arquivo `webpack.mix.js`.
```javascript
// webpack.mix.js
mix.browserSync('http://127.0.0.1:8000/')   
```

8.1 Execute o comando para que o `watch` compile automaticamente a cada mudança. E o `browserSync` atualiza o browser.
```bash
npm run watch
``` 

## Administrando Categorias

**Organização estrutura Vue**

9. Crie três pastas `admin` `frontend` e `layouts` dentro do diretório `components`.

`resources\js\components\admin`      (todos components referente administração)

`resources\js\components\frontend`   (todos components referente ao frontend)

`resources\js\components\layouts`    (todos compoents compativel ao frontend e backend)

9.1 Cria component `AdminComponent.vue` dentro da pasta `Admin`.
```javascript
<template>
    <div>
        Sou o template de admin
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

</style>
```

9.2 Crie duas pastas `layouts` e `pages` dentro do diretório `admin`.

`resources\js\components\admin\layouts`  (Todos components reutilizaveis dentro do compomente admin)

`resources\js\components\admin\pages`    (gestão de paginas de administração)

9.3 Criar pasta `categories` dentro de `pages`. E adicione component. `CategoriesComponent.vue`

```vue
<script>
// resources\js\components\admin\pages\CategoriesComponent.vue

<template>
    <div>
        Listagem das categories
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

</style>
```

9.4 Importar component `CategoriesComponent` em `routers.js`
```javascript
import CategoriesComponent from '../components/admin/pages/categories/CategoriesComponent'
```


9.5 Define a rota
```javascript
const routes = [
    {path: '/categories', component: CategoriesComponent, name: 'categories'}
]
```

9.6 Cria webComponent `App.vue` dentro `resources\js\components` 
```vue
<template>
    <div>
        <router-view></router-view> //faz roteamento dos components
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

</style>
```

9.7 Declarar component `App.vue` dentro de `app.js`
```javascript
/***
 * Components globais
 */
Vue.component('app-component', require('./components/App'))
```

9.8 Declara o component `app-component` dentro de `welcome.blade.php`
```php
// resoureces\welcome.blade.php
    
    ...

  <body>
        <div id="app">

            <app-component></app-component> //Adicionado tag do component

        </div>


    <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
```

## Organizando rotas Admin Categorias

10. Criar pasta `dashboard` dentro de `reources\js\components\admin\pages`, em seguida adicione crie component `DashboardComponent.vue`.
```vue 
<script>
// reources\js\components\admin\pages\DashboardComponent

<template>
    <div>
        pagina dashboard
    </div>
</template>
```

10.1 Define url no arquivo de rotas.

```javascript
// resources\js\routes\routers.js

import Vue from 'vue'
import VueRouter from 'vue-router'

import CategoriesComponent from '../components/admin/pages/categories/CategoriesComponent'
import DashboardComponent from '../components/admin/pages/dashboard/DashboardComponent' // Adicionado import

Vue.use(VueRouter)

const routes = [
    {path: '/categories', component: CategoriesComponent, name: 'admin.categories'},
    {path: '/', component: DashboardComponent, name: 'admin.dashboard'} // Adcionado rota com prefixo admin.
]

...

```







## Listagem Categorias

11. Adicionar menu em `AdminComponent.vue`.
```vue
<template>
    <div>
        <ul>
            <li>
                <router-link :to="{name: 'admin.dashboard'}">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{name: 'admin.categories'}">Categorias</router-link>
            </li>
        </ul>
    </div>
</template>
```

11.1 Alterar tag de component  `(Falta procedimento...)`


## Listar Categorias com Vuex

12.  `(Falta procedimento...)`

## Criar Component de Preloader

13.  `(Falta procedimento...)`

## Preloader ao carregar Categoria

14. Adicione na action que carrega as `Categorias` o carregamento do `PRELOADER`, antes de carregar o status será `true`, após o carregamento o status será `false`.
```javascript
// resources\js\vuex\modules\categories\categories.js

actions: {
        loadCategories (context) {
            context.commit('PRELOADER', true)

            axios.get('/api/v1/categories')
                    .then(response => {
                        console.log(response)

                        context.commit('LOAD_CATEGORIES', response)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
                    .finally(() => context.commit('PRELOADER', false))
        }
    },
```

## Pré-organizar Layout Admin

15. No arquivo da view `welcome.blade.php` apague qualquer configuração `css` do template default do laravel, adicione o `css` da pasta `public` usando o `mix()`.
```php
// resources\views\welcome.blade.php

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
```
15.1 No arquivo `_variables.scss` altere a cor do body para branco.
```scss
// Body
$body-bg: #FFF;
```

15.2 `(Falta procedimento...)`

## Component de Categoria

16.  `(Falta procedimento...)`

## Cadastrar nova Categoria

17. `(Falta procedimento...)`

## Component Editar Categoria

18. Criar component `EditCategoryComponent`.
```vue
<template>
    <div>
        <h1>Editar Categoria</h1>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

</style>
```

18.1 Importa a rota e adiciona compomente na rota
```javascript
import EditCategoryComponent from '../components/admin/pages/categories/EditCategoryComponent'  // import adicionado

...

const routes = [
    {
        path: '/admin', 
        component: AdminComponent,
        children: [
            {path: '', component: DashboardComponent, name: 'admin.dashboard'},
            {path: 'categories', component: CategoriesComponent, name: 'admin.categories'},
            {path: 'categories/create', component: AddCategoryComponent, name: 'admin.categories.create'},
            {path: 'categories/:id/edit', component: EditCategoryComponent, name: 'admin.categories.edit'}  //Rota adicionada

            ...
...            
```

18.2 Adiciona botão no `<tbody>` do component `CategoriesComponent`.
```php
<tbody>
    <tr v-for="(category, index) in categories.data" :key="index">
        <td>{{ category.id }}</td>
        <td>{{ category.name }}</td>
        <td>
            <router-link :to="{name: 'admin.categories.edit', params: {id: category.id}}" class="btn btn-info">Editar</router-link> // Novo botão 'Editar'
        </td>
    </tr>
</tbody>
```

18.3 Carregar a categoria, no component `EditCategoryComponent` adiciona `props` onde será passado parametro `id` obrigatório.
```javascript
// resources\js\components\admin\pages\ategories\EditCategoryComponent

export default {
    // props espera que seja passado um campo obrigatório, ou seja, valores dinamicos da url.
    props: {
        id: {
            require: true
        }
    },
```

18.4 Usar action do vuex. Criar método `loadCategory()`, adicione abaixo do método `loadCategories()`.
```javascript
// resources\js\vuex\modules\categories\categories.js

...

loadCategory (context, id) {
    context.commit('PRELOADER', true)

    return new Promise ((resolve, reject) => {
        axios.get(`/api/v1/categories/${id}`)
            .then(response => resolve(response.data))
            .catch(error => reject(error))
            .finally(() => context.commit('PRELOADER', false))            
    })
},
...
```

18.5 Agora no `EditCategoryComponent` faz a chamada do action `loadCategory()`. Após esse proceidmento já será possível visualizar o retorno pelo devtools.
```javascript
// resources\js\components\admin\pages\ategories\EditCategoryComponent
...
created () {
    this.$store.dispatch('loadCategory', this.id)
                    .then(response => this.category = response)
                    .catch(error => {
                        console.log(error)
                    })
}
    ...
```
18.6 Adiciona o formulário em `EditCategoryComponent`.
```vue

<template>
    <div>
        <h1>Editar Categoria</h1>

        <form class="form" @submit.prevent="submitForm">
            <div class="form-group">
                <input type="text" v-model="category.name" class="form-control" placeholder="Nome da Categoria">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</template>
```

18.6 Adicione o `data()` abaixo do método `created ()` para iniciar a variavel vazia, essa que receberá o valor do form.
```javascript
...

data () {
        return {
            category: {
                name: ''
            }
        }
    }
```

## Compoenent de Formulário de Categoria

Objetivo é criar um unico formulário para usar nos components da aplicação.

19. Criar pasta `partials`(conterá components comuns a categoria) dentro de `categories` e criar componente `FormCategoryComponent` que será o formulário padrão.
```javascript
// resources\js\components\admin\pages\ategories\partials\FormCategoryComponent

<template>
    <div>
        <h1>Editar Categoria</h1>

    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>

</style>

```

19.1 Adiciona o mesmo formulário que já existe nos components `AddCategoryComponent` e `EditCategoryComponente`. Após cópiar o formulário pode excluir o mesmo dos components `AddCategoryComponent` e `EditCategoryComponente`. `(Falta procedimento...)`
```javascript
//  (Falta procedimento...)
```


19.2 Cria `props` em `FormCategoryComponent` para fazer o bind. E no `v-model` do input adiciona atributo `category.name`.
```javascript
...

<input type="text" v-model="category.name" class="form-control" placeholder="Nome da Categoria">

...

<script>
export default {
    props: {
        category: {
            require: false,
            type: Object|Array,
            default: () => {
                return {
                    name: ''
                }
            }
        }
    }
}
</script>
```


19.3 Importa o component ## no component ## `(Falta procedimento...)`
```vue
<script>
import FormCategoryComponent from './partials/FormCategoryComponent'

export default {
    data () {
        // Pega o valor do form
        return {
            name: ''
        }
    },
    methods: {
        // Passa a responsabilidade de cadastro para Vuex 'categories.js'
        submitForm () {
            this.$store.dispatch('storeCategory', {name: this.name})
                            .then(() => this.$router.push({name: 'admin.categories'}))
                            .catch()
        }
    },
    components: {
        formCat: FormCategoryComponent
    }
}
</script>
```
19.4 Adicionar formulário em `EditCategoryComponent`

## Cadastrar e Editar Categoria Form Compoent

20. `(Falta procedimento...)`

## Instalação e Configurar o Vue-Snotify

 [Vue-Snotify](https://artemsky.github.io/vue-snotify/) e uma ferramenta utilizada para criar notificações em VueJs.

21. Instalar Vue-Snotify
```bash
npm install --save-dev vue-snotify
```

**Configuração do pacote Vue-Snotify**

21.1  importa o pacote `Vue-Snotify`
```javascript
// resources\js\app.js

require('./bootstrap');
window.Vue = require('vue');
import Snotify from 'vue-snotify'   //Importado pacote

import router from './routes/routers'
import store from './vuex/store'

Vue.use(Snotify, {toast: {showProgressBar: false}}) // Usa no Vue o pacote e passa parametro de false para a ação de barra progressiva 'showProgressBar'.

...
```

21.2 Utilizar o componente no template padrão `welcome.blade.php`.
```php
<body>
        <div id="app">
            <vue-snotify></vue-snotify> // Adicionado TAG 
            
            <preloader-component></preloader-component>

            
            <router-view></router-view>

        </div>


    <script src="{{ mix('/js/app.js') }}"></script>
    </body>
```

21.3 Importar o `.css` do pacote.
```scss
// Fonts
@import url('https://fonts.googleapis.com/css?family=Nunito');

// Variables
@import 'variables';

// Bootstrap
@import '~bootstrap/scss/bootstrap';

// Snotify
@import "~vue-snotify/styles/material"; //Adicionado .css do pacote Snotify


.navbar-laravel {
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}
```

## Exibir Erros de Validação Laravel com VueJs

22. `(Falta procedimento...)`

## Exibir Alerts com Snotify

23. Adicione nas resposta do `ajax` a biblioteca `Snotify`.
```vue
<script>
// resources\js\components\admin\pages\ategories\partials\FormCategoryComponent

...

methods: {
        // Passa a responsabilidade de cadastro para Vuex 'categories.js'
        onSubmit () {
            const action = this.updating ? 'updateCategory' : 'storeCategory'

            this.$store.dispatch(action, this.category)
                            .then(() => {
                                this.$snotify.success('Sucesso ao cadastrar')   //ADICIONADO PACOTE SNOTIFY C/ RESPOSTA DE SUCESSO AO CADASTRAR

                                this.$router.push({name: 'admin.categories'})
                            })
                            .catch(error => {   
                                this.$snotify.error('Algo deu errado', 'Erro')  //ADICIONADO PACOTE SNOTIFY C/ RESPOSTA DE ERROR AO CADASTRAR
                                
                                console.log(error.response.data.errors)
                                this.errors = error.response.data.errors
                            })
        }
        
```

## Deletar Categoria

24. Inserir botão no table `(Falta procedimento...)`
```javascript
 `(Falta procedimento...)`
```

**Confirmação ao Deletar Categoria**

24.1 `(Falta procedimento...)`


## Filtros Categoria

**Criar campo Search**

25. Adiciona `(Falta procedimento...)`
