import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    curcatid: null
  },
  mutations: {
    reviseCatId (state, id) {
      state.curcatid = id
      console.log(state.curcatid)
    }
  }
})

export default store
