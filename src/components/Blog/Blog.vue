<template>
  <div id="blogDetail">
    <h3 id="title" v-html="blog.title"></h3>
    <div id="content" v-html="blog.content"></div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      blog: {}
    }
  },
  created () {
    this.getBlog()
  },
  methods: {
    getBlog () {
      axios
        .get('http://localhost:80/mikesblog/servers/blog/blog.php', {
          params: {
            id: this.$route.params.id
          }
        })
        .then(res => {
          this.blog = res.data.data[0]
        })
    }
  }
}
</script>

<style scoped>

#title {
  margin-bottom: 10px;
  border-bottom: 1px dashed #dcdfe6;
}

#content{
  font-size: 14px;
}
</style>
