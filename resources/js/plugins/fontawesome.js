import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog, faEdit, faTrash, faPlus, faMinus,
  faEye, faEyeSlash, faCaretRight, faCaretDown, faLayerGroup
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub, faTwitter, faDeskpro
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faTwitter, faEdit, faTrash, faPlus, faMinus,
  faEye, faEyeSlash, faCaretRight, faCaretDown, faLayerGroup, faDeskpro
)

Vue.component('font-awesome-icon', FontAwesomeIcon)
