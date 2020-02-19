
## VueJS Definições

**v-model**
faz o bind, onde você pega o valor e joga em outro lado. No VueJs tem que declarar a variavel no data().

**v-for**
mesmo que foreach()

**v-if**
mesmo que if()

**v-if e v-else**
mesmo que if(){} else {}.

**data() {}**
Estado do componente, nele você pode criar variaveis, manupuladados também pode.

**methods: {}**
Ações do componente.

**props: {}**
propriedade, dentro é definido a variavel com suas definições (type, required, etc...). Essa variavel será enviada/consumido por outro componente.

**$emit()**
envia evento para o pai, para isso no pai tem que está escutando o evento.

**delete(ojb, param)**
remove um item, facilitador do vueJs.

**$set(param1, param2, param3)**

**Usando sprated do ECMA6**
```javascript
// declara uma variavel recebendo um objeto
fruta = {nome: 'jamelão', estado: 'verde'}
{nome: "jamelão", estado: "verde"}

// usando o sprated do ECMA6 atualiza o estado para madurin
fruta2 = { ...fruta, estado: 'madurin'}
{nome: "jamelão", estado: "madurin"}
```
**@**
quando colocar @ está definindo que está partindo da pasta /src
`@router\index.js`

----------------------------------------------------------------------
## Component

Usar componente na rota = quando um componente é uma pagina defina em routes.js.

Usar componente em outro componente = faz o import do componete, declara em components: {} é insere tag do componente no <template>.

----------------------------------------------------------------------

## VueRouter é Vuex

**VueRoter**
Uma maneira de aplicar Single Page Aplication (SPA), ou seja, varias view e navegar entre elas sem ter que carregar a pagina.

1. Intalação
```bash
npm install vue-router
```

2. Depois crie diretório router dentro de `src`, por exemplo `src\router\index.js`
```javascript
import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '@/views/Home' //import do component

Vue.use(VueRouter) //faz o use, para que o vue entenda que e um tipo de arquivo router.

const routes = [
    {
        name: 'home', //nome da rota
        path: '/', //caminho
        component: Home, //componente que será renderizado
    }
]

const router = new Router({ routes }) //faz instancia do 'routes' se são as rotas

export default router //exportar o router
```

3. No `main.js` faz o import
```javascript
import router from '@/router'
```

4. Adicio a tag do component router no `App.vue`
```vue
<template>
    <div class id="app">
        <router-view />  \\Adicionado tag da rota
    </div>
</template>
```

**<router-view>**
Usando para informar o component de roteamento.

**<router-link>**
Usando para menu, meno que tag <a>.
`<router-link to="/">Home</router-link>`




**Vuex**

1. Instalação
```sash
npm install vuex --save
```

2. Cria arquivo na raiz da view `\src\views\store.js`
```javascript
importe Vue from 'vue'
importe Vuex from 'vuex'

vue.use(Vuex)


```


