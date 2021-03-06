import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home/Home'
import Login from '@/components/Login/Login'
import BlogList from '@/components/BlogList/BlogList'
import Blog from '@/components/Blog/Blog'

Vue.use(Router)

const originalPush = Router.prototype.push
Router.prototype.push = function push (location) {
  return originalPush.call(this, location).catch(err => err)
}

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/BlogList'
    },
    {
      path: '/home',
      name: 'Home',
      component: Home,
      children: [
        {path: '/BlogList', name: 'BlogList', component: BlogList},
        {path: '/Blog/:id', name: 'Blog', component: Blog}
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    }
  ]
})
