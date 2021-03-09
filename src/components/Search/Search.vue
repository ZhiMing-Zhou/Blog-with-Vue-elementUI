<template>
  <div>
    <el-table
      :data="articalData"
      stripe
      style="width: 100%"
      :header-cell-style="{
        color: 'black',
        fontSize: '14px',
        fontWeight: 'normal'
      }"
      :row-style="{ height: '10px' }"
      :cell-style="{ padding: '5px 0' }"
      @row-click="jumpTo"
    >
      <el-table-column prop="title" label="标题"> </el-table-column>
      <el-table-column prop="status" label="发布状态" width="80" align="center">
      </el-table-column>
      <el-table-column prop="views" label="阅读数" width="80" align="center">
      </el-table-column>
    </el-table>

    <!-- 分页部分 -->

    <el-pagination
      id="pagination"
      layout="prev, pager, next"
      :total="total"
      :page-size="10"
      :current-page="pagenum"
      @current-change="clickCurrentPage"
    >
    </el-pagination>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      // 博客数据
      articalData: [],
      // 有多少条
      total: 0,
      // 页码
      pagenum: 1,
      // 关键字
      key: ''
    }
  },
  created () {
    this.key = this.$route.params.key
    this.getAllBlogs()
  },
  methods: {
    // 获取全部博客
    getAllBlogs (pagenum = 1) {
      axios
        .get('http://localhost:80/mikesblog/servers/search/search.php', {
          params: {
            pagenum,
            pagesize: 10,
            key: this.key
          }
        })
        .then(res => {
          if (res.data.data.code === 200) {
            this.articalData = res.data.data.data
            // 用于显示页码
            this.total = +res.data.data.total
          } else {
            this.$message({
              message: '无相关记录!',
              type: 'warning'
            })
          }
        })
    },
    // 点击页码
    clickCurrentPage (curpage) {
      this.getAllBlogs(curpage)
    },
    // 点击表格的行跳转到博客详情
    jumpTo (row) {
      this.$router.push(`/Blog/${row.id}`)
    }
  }
}
</script>

<style scoped>
#pagination {
  padding-right: 0px;
  float: right;
}
form button {
  display: inline-block;
  vertical-align: middle;
  height: 26px;
  padding: 0px 10px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  color: white;
  outline: none;
}

form input {
  vertical-align: middle;
  display: inline-block;
  height: 24px;
  line-height: 24px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  outline: none;
}
</style>
