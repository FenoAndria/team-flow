// import './bootstrap';

import { createApp } from 'vue'
import App from './App.vue'
import Router from './Router/Index'
const app = createApp(App)

app.use(Router).mount("#app")
