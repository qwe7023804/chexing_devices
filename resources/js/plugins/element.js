import iconPicker from 'e-icon-picker';
import 'e-icon-picker/dist/index.css';
import 'e-icon-picker/dist/main.css'


import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

Vue.use(iconPicker);
Vue.use(Element)
Vue.prototype.$ELEMENT = { size: 'small', zIndex: 3000 };
