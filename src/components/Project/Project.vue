<template>
  <div id="my_project">
    <div>
      <a href="https://zhiming-zhou.github.io/Bilibili/">
        <h5 id="title">仿B站首页</h5></a
      >
      <p id="introduce">
        一个模仿小破站首页的Demo
      </p>
    </div>
    <div>
      <a href="/BlogList"><h5 id="title">基于vue+elementUI的个人博客</h5></a>
      <p id="introduce">
        这是一个基于vue+elementUI打造的个人博客
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      activeNames: ['1']
    }
  },
  created () {
    this.changeFlag()
  },
  methods: {
    changeFlag () {
      this.$store.commit('updateFlag', true)
    }
  }
}
</script>

<style scoped>
#my_project div {
  margin: 10px 0;
}
h5 {
  padding: 10px 0px;
}
#introduce {
  font-size: 14px;
}
</style>
