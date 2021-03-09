<template>
  <el-row type="flex" justify="center" align="middle">
    <el-col :span="6">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <el-form-item size="small" label="用户名" prop="name">
          <el-input size="small" v-model="ruleForm.name"></el-input>
        </el-form-item>

        <el-form-item size="small" label="密码" prop="password">
          <el-input
            type="password"
            size="small"
            v-model="ruleForm.password"
          ></el-input>
        </el-form-item>

        <el-form-item>
          <el-button type="success" size="small" @click="statsLogin()"
            >登录</el-button
          >
          <el-button size="small" @click="resetForm('ruleForm')"
            >重置</el-button
          >
        </el-form-item>
      </el-form>
    </el-col>
  </el-row>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      ruleForm: {
        name: '',
        password: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入用户名', trigger: 'blur' },
          { min: 3, max: 8, message: '长度在 3 到 15 个字符', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入密码', trigger: 'blur' },
          { min: 3, max: 15, message: '长度在 3 到 15 个字符', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    statsLogin () {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          axios
            .get('http://localhost:80/mikesblog/servers/login/login.php', {
              params: this.ruleForm
            })
            .then(res => {
              if (res.data.data.code === 400) {
                this.$message({
                  showClose: true,
                  message: res.data.data.msg,
                  type: 'error'
                })
              } else if (res.data.data.code === 200) {
                this.$store.commit('updateLoginStatus', true)
                this.$router.push('/mAllBlogs')
              }
            })
        } else {
          this.$message({
            showClose: true,
            message: '账号或密码格式错误',
            type: 'error'
          })
        }
      })
    },
    resetForm (ruleForm) {
      this.$refs[ruleForm].resetFields()
    }
  }
}
</script>

<style scoped>
.el-row {
  height: 100%;
}

.el-col {
  background-color: white;
  padding: 10px 30px;
  border-radius: 15px;
  border: 1px solid #dcdfe6;
}
</style>
