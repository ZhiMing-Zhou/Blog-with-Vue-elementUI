<template>
  <div>
    <p>标题</p>
    <input
      id="title"
      type="text"
      placeholder="请输入标题"
      style="padding-left:20px"
      v-model="title"
    />
    <p>内容</p>
    <quill-editor ref="mTextEditor" v-model="content"></quill-editor>
    <div id="category">
      <p>请选择分类</p>
      <el-radio
        v-for="item in categories"
        :key="item.id"
        v-model="cat_id"
        :label="item.id"
        >{{ item.name }}</el-radio
      >
    </div>
    <el-button size="min" type="success" @click="submitBlog">提交</el-button>
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
      categories: [],
      title: '',
      content: '',
      cat_id: '',
      status: 'post'
    }
  },
  created () {
    this.getCategories()
  },
  methods: {
    submitBlog () {
      if (this.title.trim().length === 0 || this.content.trim().length === 0) {
        return this.$message({
          message: '请输入标题或内容!',
          type: 'warning'
        })
      }

      let params = new URLSearchParams()

      const title = this.title
      let createDay = new Date()
      createDay =
        createDay.getFullYear() +
        '-' +
        (createDay.getMonth() + 1) +
        '-' +
        createDay.getDate()
      const content = this.content
      const status = this.status
      const catId = this.cat_id

      params.append('title', title)
      params.append('create_day', createDay)
      params.append('content', content)
      params.append('status', status)
      params.append('cat_id', catId)

      axios
        .post(
          'http://localhost:80/mikesblog/servers/addblog/addblog.php',
          params
        )
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '添加成功',
              type: 'success'
            })
            this.title = ''
            this.content = ''
            this.cat_id = ''
          } else {
            this.$message({
              message: '添加失败',
              type: 'warning'
            })
          }
        })
    },
    // 加载分类
    getCategories () {
      axios
        .get('http://localhost:80/mikesblog/servers/categories/categories.php')
        .then(res => {
          this.categories = res.data.data
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
#category {
  padding-left: 14px;
  border: 1px solid #cccccc;
  border-top: none;
}
#category p {
  padding: 4px 0px;
  font-size: 12px;
  color: #757575;
}

#category .el-radio {
  margin-bottom: 4px;
}
</style>
