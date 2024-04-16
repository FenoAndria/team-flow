// import './bootstrap';

import { createApp } from 'vue'
import App from './App.vue'
import Router from './Router/Index'
import Stores from './Stores/Index'
const app = createApp(App)

app.use(Router).use(Stores).mount("#app")
