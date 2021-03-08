<template>
  <div>
    <form>
      <input type="text"  v-model='key'/>
      <button style="backgroundColor:#67C23A" @click="search">搜索</button>
    </form>
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
      // 当前分类Id
      curCatId: null,
      // 搜索关键字
      key: ''
    }
  },
  created () {
    // 在从全局拿到curCatId
    this.curCatId = this.$store.state.curCatId

    // 加载博客
    this.loadBlogData(1, this.curCatId)
  },
  methods: {
    // 获取全部博客
    getAllBlogs (pagenum) {
      axios
        .get('http://localhost:80/mikesblog/servers/list/list.php', {
          params: {
            pagenum,
            pagesize: 10
          }
        })
        .then(res => {
          this.articalData = res.data.data.data
          this.total = +res.data.data.total
          this.pagenum = +res.data.data.pagenum
        })
    },
    // 获取指定分类博客
    getBlogsInCate (pagenum, catid) {
      axios
        .get(
          'http://localhost:80/mikesblog/servers/blogsincategory/blogsincategory.php',
          {
            params: {
              pagenum,
              pagesize: 10,
              catid
            }
          }
        )
        .then(res => {
          this.articalData = res.data.data.data
          this.total = +res.data.data.total
          this.pagenum = +res.data.data.pagenum
        })
    },
    /**
     * 加载博客
     * @params pagenum [num] 页码
     * @params catid  [num] 分类ID
     */
    loadBlogData (pagenum, catid) {
      // 设置默认值
      pagenum = pagenum || 1
      // 如果没有catid,加载全部博客，有则加载catid对应的博客
      if (!catid) {
        this.getAllBlogs(pagenum)
      } else {
        // 如果有catid,加载catid对应的博客
        this.getBlogsInCate(pagenum, catid)
      }
    },
    // 点击页码
    clickCurrentPage (curpage) {
      this.loadBlogData(curpage, this.curCatId)
    },
    // 点击表格的行跳转到博客详情
    jumpTo (row) {
      this.$router.push(`/Blog/${row.id}`)
    },
    search () {
      axios.get('http://localhost:80/mikesblog/servers/search/search.php', {
        params: {
          key: this.key
        }
      }).then(res => {
        console.log(res)
        if (res.data.data.code === 400) {
          this.$message({
            message: '未找到匹配数据',
            type: 'warning'
          })
          this.key = ''
        } else {
          // this.articalData = res.data.data.data
          // this.total = +res.data.data.total
          // this.pagenum = +res.data.data.pagenum
        }
      })
    }
  }
}
</script>

<style scoped>
#pagination {
  padding-right: 0px;
  float: right;
}
form button{
  display: inline-block;
  vertical-align: middle;
  height:30px;
  padding:0px 10px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  color: white;
  outline: none;
}

form input{
  vertical-align: middle;
  display: inline-block;
  height: 30px;
  line-height: 30px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  outline: none;
}
</style>
