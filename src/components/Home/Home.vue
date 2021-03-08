<template>
  <el-container>
    <!-- 头 -->
    <el-header height="80px">
      <el-row type="flex" justify="space-between" align="middle">
        <el-col :span="8">
          In me, the tigger sniffs the rose.
        </el-col>
        <el-col :span="8" class="nav">
          <el-row type="flex" justify="space-between">
            <el-col :span="4"
              ><router-link to="/BlogList">首页</router-link></el-col
            >
            <el-col :span="4"
              ><router-link to="/Project">项目</router-link></el-col
            >
            <el-col :span="4"
              ><router-link to="/Login">登录</router-link></el-col
            >
            <el-col :span="4"
              ><a href="https://github.com/ZhiMing-Zhou"
                >GitHub</a
              ></el-col
            >
          </el-row>
        </el-col>
      </el-row>
    </el-header>
    <el-container>
      <!-- 左侧导航 -->
      <el-aside width="230px" :class="{ hide: flag }">
        <h5>分类:</h5>
        <ul class="aside-nav">
          <li
            @click="getThisCategoryBlog(item.id)"
            v-for="item in categories"
            :key="item.id"
          >
            {{ item.name }}
          </li>
        </ul>
      </el-aside>
      <!-- 内容区 -->
      <el-main>
        <router-view ref="BlogList"></router-view>
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      // 分类
      categories: []
    }
  },
  created () {
    this.getCategories()
  },
  methods: {
    // 加载分类
    getCategories () {
      axios
        .get('http://localhost:80/mikesblog/servers/categories/categories.php')
        .then(res => {
          this.categories = res.data.data
        })
    },
    //  点击分类加载博客
    getThisCategoryBlog (curCatId) {
      // 先把curCatId保存到全局
      this.$store.commit('updateCurCatId', curCatId)

      // 然后再跳转
      this.$router.push('/BlogList')

      // 更新子组件的当前分类ID(分页)
      this.$refs.BlogList.curCatId = curCatId

      // 执行子组件的加载博客方法
      this.$refs.BlogList.loadBlogData(1, curCatId)
    }
  },
  computed: {
    flag () {
      return this.$store.state.flag
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-container {
  width: 1150px;
  margin: 0 auto;
}
.el-header {
  background-color: white;
  padding: 0;
  color: black;
  border-bottom: 1px solid #dcdfe6;
}
.el-header .el-row {
  line-height: 78px;
}
.el-header .nav {
  text-align: center;
  width: 300px;
}
.el-header .nav .el-col:hover {
  cursor: pointer;
  font-weight: bold;
}
.el-aside {
  background-color: white;
}
.el-aside {
  padding-top: 30px;
}
.el-aside h5 {
  height: 30px;
}
.el-aside .aside-nav li {
  height: 20px;
  line-height: 20px;
  font-size: 12px;
}
.el-aside .aside-nav li:hover {
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
}
a {
  color: black;
  display: block;
  width: 100%;
  height: 100%;
}
/* a:hover {
  color: black;
}
a:visited {
  color: black;
}
a:active {
  color: black;
} */
.hide {
  display: none;
}
</style>
