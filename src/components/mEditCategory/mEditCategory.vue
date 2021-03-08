<template>
  <div>
    <el-table
      :data="categories"
      style="width: 100%"
      :header-cell-style="{
        color: 'black',
        fontSize: '14px',
        fontWeight: 'normal'
      }"
      :row-style="{ height: '10px' }"
      :cell-style="{ padding: '5px 0' }"
    >
      <el-table-column prop="name" label="分类"> </el-table-column>
      <el-table-column prop="operate" label="操作" width="150" align="center">
        <template slot-scope="scope">
          <el-popover
            placement="bottom"
            title="分类名称"
            width="200"
            trigger="click"
          >
            <input type="text" v-model="rename"/>
            <el-button type="success" @click="updataName(scope.index,scope.row)">确认</el-button>
            <el-button type="warning" @click="cancelUpdate">取消</el-button>
            <el-button slot="reference" type="success" size="mini"
              >编辑</el-button
            >
          </el-popover>

          <el-popconfirm
            confirm-button-text="确定"
            cancel-button-text="再想想"
            icon="el-icon-info"
            icon-color="red"
            title="确定要删除此分类吗？"
            @confirm="handleDelete(scope.$index, scope.row)"
          >
            <el-button slot="reference" size="mini" type="danger"
              >删除</el-button
            >
          </el-popconfirm>
        </template>
      </el-table-column>
    </el-table>
    <div class="addcategory">
      <p>添加分类</p>
      <input type="text" v-model="new_cat_name" />
      <el-button
        size="small"
        type="success"
        style="display:block"
        @click="addCategory"
        >确定</el-button
      >
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      categories: [{ id: 0, name: 'jq' }],
      new_cat_name: '',
      rename: ''
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
    // 添加分类
    addCategory () {
      if (this.new_cat_name.trim().length === 0) {
        return false
      }
      axios
        .get(
          'http://localhost:80/mikesblog/servers/addcategory/addcategory.php',
          {
            params: {
              new_cat_name: this.new_cat_name
            }
          }
        )
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '添加成功!',
              type: 'success'
            })
            this.getCategories()
            this.new_cat_name = ''
          } else {
            this.$message({
              message: '添加失败!',
              type: 'success'
            })
          }
        })
    },
    // 删除分类
    handleDelete (index, row) {
      let catId = row.id
      axios
        .get(
          'http://localhost:80/mikesblog/servers/delcategory/delcategory.php',
          {
            params: {
              id: catId
            }
          }
        )
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '删除成功!',
              type: 'success'
            })
            this.getCategories()
          } else {
            this.$message({
              message: '删除失败!',
              type: 'warning'
            })
          }
        })
    },
    // 更改分类名
    updataName (index, row) {
      if (this.rename.trim().length === 0) {
        this.$message({
          message: '请输入名称',
          type: 'warning'
        })
        return false
      }
      axios
        .get(
          'http://localhost:80/mikesblog/servers/updatename/updatename.php',
          {
            params: {
              id: row.id,
              rename: this.rename
            }
          }
        )
        .then(res => {
          if (res.data.data.code === 200) {
            this.$message({
              message: '修改成功!',
              type: 'success'
            })
            this.rename = ''
            document.body.click()
            this.getCategories()
          } else {
            this.$message({
              message: '修改失败!',
              type: 'warning'
            })
          }
        })
    },
    cancelUpdate () {
      this.rename = ''
      document.body.click()
    }
  }
}
</script>

<style scoped>
.el-button {
  padding: 4px 8px;
}
.addcategory {
  width: 200px;
  margin-top: 10px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  padding: 0px 10px;
  font-size: 14px;
  overflow: hidden;
}
.addcategory p {
  padding: 10px 0;
}
.addcategory input {
  height: 24px;
  width: 100%;
  outline: none;
  border: 1px solid #cccccc;
  margin-bottom: 10px;
}
.addcategory .el-button {
  margin-bottom: 10px;
  float: right;
}
.el-table .el-table__row {
  padding: 0;
}
.el-popover input {
  margin-bottom: 10px;
  display: block;
  height: 20px;
  outline: none;
  border: 1px solid #cccccc;
}
</style>
