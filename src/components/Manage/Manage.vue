<template>
  <el-container>
    <!-- 头 -->
    <el-header height="80px">
      <el-row type="flex" justify="space-between" align="middle">
        <el-col :span="8">
          In me, the tigger sniffs the rose.
        </el-col>
        <el-col :span="8" class="nav">
          <el-row type="flex" justify="end">
            <el-col :span="4"><router-link to="">退出</router-link></el-col>
          </el-row>
        </el-col>
      </el-row>
    </el-header>
    <el-container>
      <!-- 左侧导航 -->
      <el-aside width="230px">
        <h5>仪表盘:</h5>
        <el-row class="tac">
          <el-col :span="24">
            <el-menu
              default-active="1"
              class="el-menu-vertical-demo"
              active-text-color="#000000"
              :router="true"
            >
              <el-menu-item index="/mAllBlogs">
                <span slot="title">全部博客</span>
              </el-menu-item>
              <el-menu-item index="/mAddBlog">
                <span slot="title">添加博客</span>
              </el-menu-item>
              <el-menu-item index="/mComments">
                <span slot="title">管理评论</span>
              </el-menu-item>
              <el-menu-item index="/mUser">
                <span slot="title">用户</span>
              </el-menu-item>
              <el-menu-item index="/mSetting">
                <span slot="title">设置</span>
              </el-menu-item>
            </el-menu>
          </el-col>
        </el-row>
      </el-aside>
      <!-- 内容区 -->
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  data () {
    return {}
  },
  created () {},
  methods: {}
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
  height: 30px;
  line-height: 30px;
  font-size: 12px;
}
.el-aside .aside-nav li:hover {
  /* font-size: 14px; */
  cursor: pointer;
  padding-left: 5px;
  transition: padding 0.3s;
}
.el-menu-item{
  height: 40px;
  line-height: 40px;
  padding:0 !important;
}
.el-menu-item:hover{
  background-color: rgb(245, 245, 245) !important;
}
.el-menu-item.is-active{
  background-color:rgb(245, 245, 245) !important ;
}
a {
  display: block;
  width: 100%;
  height: 100%;
}
</style>
