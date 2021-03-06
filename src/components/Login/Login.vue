<template>
    <el-row type="flex" justify="center" align="middle">
      <el-col :span="8">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
          <el-form-item label="用户名" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>

          <el-form-item label="密码" prop="password">
            <el-input v-model="ruleForm.password"></el-input>
          </el-form-item>

          <el-form-item>
            <el-button type="success" @click="statsLogin()">登录</el-button>
            <el-button @click="resetForm('ruleForm')">重置</el-button>
          </el-form-item>
        </el-form>
      </el-col>
    </el-row>
</template>

<script>

export default {
  data () {
    return {
      ruleForm: {
        name: 'admin',
        password: 'mike19931211'
      },
      rules: {
        name: [
          { required: true, message: '请输入用户名', trigger: 'blur' },
          { min: 3, max: 8, message: '长度在 3 到 15 个字符', trigger: 'blur' }
        ],
        password: [{ required: true, message: '请输入密码', trigger: 'blur' },
          { min: 3, max: 15, message: '长度在 3 到 15 个字符', trigger: 'blur' }
        ]

      }
    }
  },
  methods: {
    statsLogin () {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          console.log('good')
          // 发送请求
        } else {
          this.$message({
            showClose: true,
            message: '账号或密码格式错误',
            type: 'error'
          })
        }
      })
    },
    resetForm (formName) {
      this.$refs[formName].resetFields()
    }
  }
}
</script>

<style scoped>

.el-row{
  height: 100%;
  background-color: #2d434c;
}

body,html{
  background-color: #2d434c;
}

.el-col{
  background-color: white;
  padding: 20px 30px;
  border-radius: 15px;
}
</style>
