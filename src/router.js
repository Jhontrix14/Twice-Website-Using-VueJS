import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './views/Home'
import Products from './views/Products'
import About from './views/About'
import Account from './views/Account'
import ProductDetails from './views/ProductDetails'
import Cart from './views/Cart'


Vue.use(VueRouter)

const router = new VueRouter({
  scrollBehavior(to) {
      if (to.name === 'product-details'){
        return {
          x: 0,
          y: 150,
          };
      } else {
        return {
          x: 0,
          y: 0,
          }
      }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        title: 'Twice | Once',
      }
    },
    {
      path: '/products',
      name: 'products',
      component: Products,
      meta: {
        title: 'ALL PRODUCTS - Twice | Once',
      }
    },
    {
      path: '/about',
      name: 'about',
      component: About,
      meta: {
        title: 'ABOUT US - Twice | Once',
      }
    },
    {
      path: '/account',
      name: 'account',
      component: Account,
      meta: {
        title: 'ACCOUNT - Twice | Once',
      }
    },
    {
      path: '/product/no/:product_no',
      name: 'product-details',
      component: ProductDetails,
      meta: {
        title: 'Twice | Once',
      }
    },
    {
      path: '/cart',
      name: 'Cart',
      component: Cart,
      meta: {
        title: 'Twice | Once',
      }
    },
  ]
}
)

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next()
})



export default router
