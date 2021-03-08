import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    // 是否登录，记录登录状态
    isLogin: false,
    // 当前分类的ID
    curCatId: null,
    // 是否隐藏侧边栏
    flag: false
  },
  mutations: {
    updateLoginStatus (state, status) {
      state.isLogin = status
    },
    updateCurCatId (state, curCatId) {
      state.curCatId = curCatId
    },
    updateFlag (state, status) {
      state.flag = status
    }
  }
})

export default store
