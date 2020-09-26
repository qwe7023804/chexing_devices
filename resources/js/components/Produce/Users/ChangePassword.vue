<template>
    <div>
        <el-dialog title="修改密码" :visible.sync="changepassword" width="20%">
            <el-form :model="userform" ref="userform" :rules="rules" @submit.native.prevent>
                <el-form-item label="新密码" prop="password">
                    <el-input
                            placeholder="请输入密码"
                            v-model="userform.password"
                            show-palidateForssword
                            @keyup.enter.native="changepass"
                    >
                    </el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <div slot="footer" class="dialog-footer">
                    <el-button @click="changepassword = false">取 消</el-button>
                    <el-button type="primary" @click="changepass('userform')">确 定</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "ChangePassword",
        inject: ['reload'],
        data() {
            return {
                user_id: '',
                changepassword: false,
                userform: {
                    password: '',
                },
                rules: {
                    password: [
                        {required: true, message: '请输入密码'},
                        {min: 6, max: 20, message: '长度6-20个字符'}
                    ]
                }
            }
        },
        methods: {
            childFun(user_id) {
                this.changepassword = true;
                this.user_id = user_id;
            },
            changepass(userform) {
                this.$refs.userform.validate((valid) => {
                    if (valid) {
                        var vm = this;
                        this.$post(this.$produce.editPassword, {
                            user_id: this.user_id,
                            password: this.userform.password,
                        }).then((res) => {
                            if (res.code === 200) {
                                vm.$message({message: "修改成功!", type: "success"});
                                vm.reload();
                            } else {
                                vm.$message.error({message: res.msg})
                            }
                        })
                    } else {
                        return false;
                    }
                });
            },
        },
    }
</script>

<style scoped>

</style>