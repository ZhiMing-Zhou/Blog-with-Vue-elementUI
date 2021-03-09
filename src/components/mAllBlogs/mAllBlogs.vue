<template>
  <div>
    <el-table
      :data="tableData"
      style="width: 100%"
      :header-cell-style="{
        color: 'black',
        fontSize: '14px',
        fontWeight: 'normal'
      }"
      :row-style="{ height: '10px' }"
      :cell-style="{ padding: '5px 0' }"
    >
      <el-table-column prop="title" label="标题"> </el-table-column>
      <el-table-column prop="status" label="发布状态" width="80" align="center">
      </el-table-column>
      <el-table-column prop="views" label="阅读数" width="80" align="center">
      </el-table-column>
      <el-table-column prop="operate" label="操作" width="150" align="center">
        <template slot-scope="scope">
          <el-button
            size="mini"
            type="success"
            @click="handleEdit(scope.$index, scope.row)"
            >编辑</el-button
          >
          <el-popconfirm
            confirm-button-text="确定"
            cancel-button-text="再想想"
            icon="el-icon-info"
            icon-color="red"
            title="确定要删除此博客吗？"
            @confirm='handleDelete(scope.$index, scope.row)'
          >
            <el-button
              slot="reference"
              size="mini"
              type="danger"
              >删除</el-button
            >
          </el-popconfirm>
        </template>
      </el-table-column>
    </el-table>
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
      tableData: [
        {
          title: 'hi',
          status: 'post',
          views: 1
        }
      ],
      // 有多少条
      total: 0,
      // 页码
      pagenum: 1,
      // 分类id
      curcatid: null
    }
  },
  created () {
    this.loadBlogData(this.pagenum, this.curcatid)
  },
  methods: {
    // 获取全部分类博客
    getAllBlogs (pagenum) {
      axios
        .get('http://localhost:80/mikesblog/servers/list/list.php', {
          params: {
            pagenum,
            pagesize: 10
          }
        })
        .then(res => {
          if (res.data.data.code === 200) {
            this.tableData = res.data.data.data
            this.total = +res.data.data.total
          } else {
            this.tableData = []
            this.total = 0
          }
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
          if (res.data.data.code === 200) {
            this.tableData = res.data.data.data
            this.total = +res.data.data.total
          }
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
      this.loadBlogData(curpage, this.curcatid)
    },
    // 点击编辑
    handleEdit (index, row) {
      this.$router.push(`/mEditBlog/${row.id}`)
    },
    // 点击删除
    handleDelete (index, row) {
      axios
        .get(
          'http://localhost:80/mikesblog/servers/deleteblog/deleteblog.php',
          {
            params: {
              id: row.id
            }
          }
        )
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '删除成功',
              type: 'success'
            })
            this.pagenum = Math.ceil(res.data.data.total / 10)
            this.loadBlogData(this.pagenum)
          } else {
            this.$message({
              message: '删除失败!',
              type: 'warning'
            })
          }
        })
    }
  }
}
</script>

<style scoped>
.el-button {
  padding: 4px 8px;
}
#pagination {
  padding-right: 0px;
  float: right;
}
</style>
