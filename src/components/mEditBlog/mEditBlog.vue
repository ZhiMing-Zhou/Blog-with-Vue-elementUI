<template>
  <div>
    <p>标题</p>
    <input
      id="title"
      type="text"
      placeholder="请输入标题"
      style="padding-left:20px"
      v-model="blog.title"
    />
    <p>内容</p>
    <quill-editor
      ref="myTextEditor"
      v-model="blog.content"
    ></quill-editor>
    <el-button size="min" type="success" @click="submitRevise">提交</el-button>

  </div>
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'
import axios from 'axios'

export default {
  data () {
    return {
      blog: {
        title: '',
        content: ''
      }
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
    },
    submitRevise () {
      let params = new URLSearchParams()

      const id = this.$route.params.id
      const title = this.blog.title
      const content = this.blog.content

      params.append('id', id)
      params.append('title', title)
      params.append('content', content)

      axios.post('http://localhost:80/mikesblog/servers/reviseblog/reviseblog.php', params)
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '修改成功',
              type: 'success'
            })
            this.blog.title = ''
            this.blog.content = ''
          } else {
            this.$message({
              message: '修改失败',
              type: 'warning'
            })
          }
        })
    }
  },
  components: { quillEditor }
}
</script>

<style scoped>
#title {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border: 1px solid #cccccc;
  outline: none;
  height: 20px;
  font-size: 12px;
  margin-bottom: 5px;
}
.el-button {
  float: right;
  padding: 6px 8px;
  margin-top: 5px;
}
</style>
