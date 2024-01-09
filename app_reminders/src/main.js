import './assets/main.css'

import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

createPinia().use(({store}) => {
    store.router = markRaw(router)
})

app.use(createPinia())
app.use(router)

app.mount('#app')
