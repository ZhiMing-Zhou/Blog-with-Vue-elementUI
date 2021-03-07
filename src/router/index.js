import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home/Home'
import Login from '@/components/Login/Login'
import BlogList from '@/components/BlogList/BlogList'
import Blog from '@/components/Blog/Blog'
import Manage from '@/components/Manage/Manage'
import mAllBlogs from '@/components/mAllBlogs/mAllBlogs'
import mUser from '@/components/mUser/mUser'
import mComments from '@/components/mComments/mComments'
import mAddBlog from '@/components/mAddBlog/mAddBlog'
import mSetting from '@/components/mSetting/mSetting'
import mEditBlog from '@/components/mEditBlog/mEditBlog'
import store from '@/store/store.js'

Vue.use(Router)

const originalPush = Router.prototype.push
Router.prototype.push = function push (location) {
  return originalPush.call(this, location).catch(err => err)
}

const router = new Router({
  routes: [
    {
      path: '/',
      redirect: 'BlogList'
    },
    {
      path: '/home',
      name: 'Home',
      component: Home,
      redirect: 'BlogList',
      children: [
        { path: '/BlogList', name: 'BlogList', component: BlogList },
        { path: '/Blog/:id', name: 'Blog', component: Blog }
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/Manage',
      name: 'Manage',
      component: Manage,
      redirect: 'mAllBlogs',
      children: [
        { path: '/mAllBlogs', name: 'mAllBlogs', component: mAllBlogs },
        { path: '/mAddBlog', name: 'mAddBlog', component: mAddBlog },
        { path: '/mComments', name: 'mComments', component: mComments },
        { path: '/mSetting', name: 'mSetting', component: mSetting },
        { path: '/mUser', name: 'mUser', component: mUser },
        { path: '/mEditBlog/:id', name: 'mEditBlog', component: mEditBlog }
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  const nextRoute = ['mAllBlogs', 'mAddBlog', 'mComments', 'mSetting', 'mUser', 'mEditBlog']
  if (nextRoute.indexOf(to.name) >= 0) {
    if (store.state.isLogin === true) {
      return next()
    } else {
      return next('login')
    }
  } else {
    return next()
  }
})

export default router
