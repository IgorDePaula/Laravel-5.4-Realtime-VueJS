// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import * as io from 'socket.io-client'

window.io = io
import VueEcho from 'vue-echo'
Vue.config.productionTip = false
const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9mYWtldG9rZW4iLCJpYXQiOjE0OTA2NjQ3NzgsImV4cCI6MTQ5MDY2ODM3OCwibmJmIjoxNDkwNjY0Nzc4LCJqdGkiOiI0MTgzZmZmYjM3ZTJjM2QyNWQzODQ3NjcwMjg4NDQ4OCJ9.e1Wo_EVp1sG4hZ1C9qFxAim5VtLkw0r06X-09N7fn-o'
const config = {
  broadcaster: 'socket.io',
  host: 'http://localhost:6001',
  auth:{
    headers:{
      'Authorization': `Bearer ${token}`
    }
  }
}

Vue.use(VueEcho, config)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
