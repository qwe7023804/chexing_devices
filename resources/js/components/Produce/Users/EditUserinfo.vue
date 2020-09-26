<template>
    <div>
        <el-dialog :title='title' :visible.sync="edituserinfo" width="20%">
            <el-form :data="userform" :model="userform" ref="userform" :rules="rules" @submit.native.prevent>
                <el-form-item label="用户名">
                    <el-input v-model="userform.username" :disabled="true"></el-input>
                </el-form-item>
                <el-form-item label="昵称">
                    <el-input v-model="userform.name" minlength="2" maxlength="10"></el-input>
                </el-form-item>
                <el-form-item label="创建时间">
                    <el-input v-model="userform.created_at" :disabled="true"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <div slot="footer" class="dialog-footer">
                    <el-button @click="edituserinfo = false">取 消</el-button>
                    <el-button type="primary" @click="updateUser('userform')">确 定</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "EditUserinfo",
        inject: ['reload'],
        data() {
            return {
                title: '',
                user_id: 0,
                edituserinfo: false,
                userform: {
                    name: ''
                },
                rules: {
                    name: [
                        {required: true, message: '请输入密码'},
                        {min: 2, max: 10, message: '长度2-10个字符'}
                    ]
                },
            }
        },
        methods: {
            childFun(title) {
                this.user_id = title.user_id;
                this.title = title.title;
                this.userinfo();
            },
            userinfo() {
                var vm = this;
                this.$get(this.$produce.editUsers + this.user_id + '/edit').then((res) => {
                    if (res.code === 200) {
                        vm.edituserinfo = true;
                        vm.userform = res.data;
                    } else {
                        vm.$message.error({message: res.msg});
                    }
                })
            },
            updateUser(userform) {
                this.$refs.userform.validate((valid) => {
                    if (valid) {
                        var _this = this;
                        this.$patch(this.$produce.updateUsers + this.user_id, {
                            name: this.userform.name,
                        }).then((res) => {
                            if (res.code === 200) {
                                _this.$message({message: "修改成功!", type: "success"});
                                _this.reload();
                            } else {
                                _this.$message.error({message: res.msg});
                            }
                        })
                    } else {
                        return false;
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>