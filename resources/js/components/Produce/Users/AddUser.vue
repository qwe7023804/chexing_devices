<template>
    <div>
        <el-dialog :title="dialogTitle" :visible.sync="adduser" width="30%" @close="resetForm">
            <el-form label-width="80px" :model="userform" ref="userform" size="small"
                     :rules="rules">
                <el-form-item label="用户名" prop="username">
                    <el-input placeholder="请输入账号" v-model="userform.username"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                    <el-input placeholder="请输入密码" v-model="userform.password" show-palidateForssword></el-input>
                </el-form-item>
                <el-form-item label="昵称" prop="nickname">
                    <el-input placeholder="请输入昵称" v-model="userform.nickname"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="resetForm">重置</el-button>
                <el-button @click="adduser = false">取 消</el-button>
                <el-button type="primary" @click="addusers">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddUser",
        inject: ['reload'],
        data() {
            return {
                adduser: false,
                dialogTitle: '新增用户',
                userform: {
                    username: '',
                    password: '',
                    nickname: ''
                },
                rules: {
                    username: [
                        {required: true, message: '请输入用户名', trigger: 'blur'},
                        {min: 6, max: 10, message: '长度6-10个字符', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                        {min: 6, max: 20, message: '长度6-20个字符', trigger: 'blur'}
                    ],
                    nickname: [
                        {required: true, message: '昵称', trigger: 'blur'},
                        {min: 2, max: 10, message: '长度2-10个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            addusers() {
                var vm = this
                this.$post(this.$produce.addUsers, {
                    username: this.userform.username,
                    password: this.userform.password,
                    nickname: this.userform.nickname,
                }).then((res) => {
                    if (res.code === 200) {
                        vm.$message({message: " 添加成功!", type: "success"});
                        vm.reload();
                    } else {
                        vm.$message.error({message: res.msg});
                    }
                })
            },
            resetForm() {
                this.$refs['userform'].resetFields();
            },
            refresh() {
                this.$emit('Refresh')
            },
            childFun() {
                this.adduser = true
            }
        }
    }
</script>

<style scoped>

</style>