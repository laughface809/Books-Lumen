import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from '@nuxt/ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _5c54018e = () => interopDefault(import('../pages/categories/index.vue' /* webpackChunkName: "pages/categories/index" */))
const _4c110902 = () => interopDefault(import('../pages/login/index.vue' /* webpackChunkName: "pages/login/index" */))
const _4cef2ce1 = () => interopDefault(import('../pages/users/index.vue' /* webpackChunkName: "pages/users/index" */))
const _397a7d1a = () => interopDefault(import('../pages/users/add/index.vue' /* webpackChunkName: "pages/users/add/index" */))
const _52ae470e = () => interopDefault(import('../pages/users/edit/_id/index.vue' /* webpackChunkName: "pages/users/edit/_id/index" */))
const _da572ab0 = () => interopDefault(import('../pages/index.vue' /* webpackChunkName: "pages/index" */))

// TODO: remove in Nuxt 3
const emptyFn = () => {}
const originalPush = Router.prototype.push
Router.prototype.push = function push (location, onComplete = emptyFn, onAbort) {
  return originalPush.call(this, location, onComplete, onAbort)
}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/categories",
    component: _5c54018e,
    name: "categories"
  }, {
    path: "/login",
    component: _4c110902,
    name: "login"
  }, {
    path: "/users",
    component: _4cef2ce1,
    name: "users"
  }, {
    path: "/users/add",
    component: _397a7d1a,
    name: "users-add"
  }, {
    path: "/users/edit/:id",
    component: _52ae470e,
    name: "users-edit-id"
  }, {
    path: "/",
    component: _da572ab0,
    name: "index"
  }],

  fallback: false
}

function decodeObj(obj) {
  for (const key in obj) {
    if (typeof obj[key] === 'string') {
      obj[key] = decode(obj[key])
    }
  }
}

export function createRouter () {
  const router = new Router(routerOptions)

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    const r = resolve(to, current, append)
    if (r && r.resolved && r.resolved.query) {
      decodeObj(r.resolved.query)
    }
    return r
  }

  return router
}
