export default localStorage.getItem('vuex') ? JSON.parse(localStorage.getItem('vuex')).Auth.userData : ''
