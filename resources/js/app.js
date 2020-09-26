/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
// window.Vue = require('vue');

import Vue from 'vue'
import router from './router'
import App from './App.vue'

import './plugins/element.js'
import {post, get, put, deletes, patch, toJson, isEmpty} from './plugins/http.js' // 请求方式中间件
import {sp110, tools, produce} from './plugins/api.js'  // API 链接
import './public/icon/iconfont.css'  //阿里图标

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// 定义全局变量
Vue.prototype.$sp110 = sp110;
Vue.prototype.$tools = tools;
Vue.prototype.$produce = produce;
Vue.prototype.$post = post;
Vue.prototype.$get = get;
Vue.prototype.$put = put;
Vue.prototype.$delete = deletes;
Vue.prototype.$patch = patch;
Vue.prototype.$toJson = toJson;
Vue.prototype.$isEmpty = isEmpty;


const app = new Vue({
    router,
    el: '#app',
    components: { App }
});
