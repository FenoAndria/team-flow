// import './bootstrap';

import dayjs from 'dayjs'
import { createApp } from 'vue'
import App from './App.vue'
import Router from './Router/Index'
import Stores from './Stores/Index'

const app = createApp(App)
app.config.globalProperties.$dayjs = dayjs
app.use(Router).use(Stores).mount("#app")
