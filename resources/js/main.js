import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/App'
import UrlHelper from '~/mixins/UrlHelper'
import _ from '~/mixins/lodash'
import vSelect from 'vue-select'
import VueSlimScroll from 'vue-slimscroll'


import '~/plugins'
import '~/components'

Vue.config.productionTip = false;
Vue.use(VueSlimScroll);
Vue.component('v-select', vSelect)
Vue.mixin(UrlHelper);
Vue.mixin(_);

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
