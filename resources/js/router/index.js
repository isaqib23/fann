import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '~/store/index'
import routes from './routes'
import { api } from '~/config'
import NProgress from 'nprogress';

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
})

router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})

router.beforeEach(async (to, from, next) => {
  if (store.getters['auth/token'] && !store.getters['auth/check']) {
    try {
      await store.dispatch('auth/fetchUser')
    } catch (e) {
        console.log(to)
    }
  }

  let route = reroute(to)
  if (route) {
    next(route)
  }
  else {
    next()
  }
})

const rules = {
  guest: { fail: 'index', check: () => (!store.getters['auth/check']) },
  businessOwner: { fail: 'login', check: () => (store.getters['auth/type'] == 'businessOwner') },
  influencer: { fail: 'login', check: () => (store.getters['auth/type'] == 'influencer') },
}

function reroute(to) {
  let failRoute = false,
      checkResult = false

  to.meta.rules && to.meta.rules.forEach(rule => {
    let check = false
    if (Array.isArray(rule)) {
      let checks = []
      for (let i in rule) {
        checks[i] = rules[rule[i]].check()
        check = check || checks[i]
      }
      if (!check && !failRoute) {
        failRoute = rules[rule[checks.indexOf(false)]].fail
      }
    }
    else {
      check = rules[rule].check()
      if (!check && !failRoute) {
        failRoute = rules[rule].fail
      }
    }

    checkResult = checkResult && check
  })

  if (!checkResult && failRoute) {
    return { name: failRoute }
  }

  return false
}

export default router
