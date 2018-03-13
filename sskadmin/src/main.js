// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueQuillEditor from 'vue-quill-editor'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import axios from 'axios'
import $ from 'jquery'

import router from './router'
import App from './App'

Vue.prototype.$http = axios;


Vue.prototype.host = '/api';

Vue.use(ElementUI)
Vue.use(VueQuillEditor)


Vue.config.productionTip = false    //生产环境提示

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
