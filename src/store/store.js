import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    isLogin: false
  },
  mutations: {
    reviseLoginStatus (state, status) {
      this.state.isLogin = status
    }
  }
})

export default store
