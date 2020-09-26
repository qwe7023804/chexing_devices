<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-button type="primary" icon="el-icon-plus" @click="adduser">添加用户</el-button>
            </el-col>
        </el-row>

        <el-table
                :data="users_list"
                border
                style="width: 100%">
            <el-table-column
                    prop="username"
                    label="用户名"
            >
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="昵称"
            >
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="创建时间"
            >
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    label="修改时间"
            >
            </el-table-column>
            <el-table-column
                    label="权限"
            >
                <template slot-scope="scope">
                    <el-button v-if="scope.row.username != 'admin'" type="primary" size="small">编辑权限</el-button>
                </template>
            </el-table-column>

            <el-table-column
                    label="操作"
                    min-width="150px"
            >
                <template slot-scope="scope" v-if="scope.row.username != 'admin'">
                    <el-button @click="editpass(scope.row.id)" size="small">修改密码</el-button>
                    <el-button type="primary" @click="edituser(scope.row.id)" size="small">编辑</el-button>
                    <el-popconfirm
                            confirmButtonText='删除'
                            cancelButtonText='取消'
                            confirmButtonType="danger"
                            icon="el-icon-info"
                            placement="left-end"
                            iconColor="red"
                            title="是否删除此用户？"
                            @onConfirm="deluser(scope.row)"
                    >
                        <el-button style="margin-left: 10px" type="danger" size="small" slot="reference">删除</el-button>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>

        <!--添加用户-->
        <add-user ref="childUser" @Refresh="refresh"></add-user>

        <!--修改密码-->
        <change-password ref="childPassword" @Refresh="refresh"></change-password>

        <!--修改用户-->
        <edit-userinfo ref="childUserinfo" @Refresh="refresh"></edit-userinfo>
    </div>
</template>

<script>
    import AddUser from "@/components/Tools/Users/AddUser";
    import EditUserinfo from "@/components/Tools/Users/EditUserinfo";
    import ChangePassword from "@/components/Tools/Users/ChangePassword";


    export default {
        name: "index",
        inject: ['reload'],
        components: {
            AddUser,
            ChangePassword,
            EditUserinfo,
        },
        data() {
            return {
                users_list: [],
                usertitle: '',
                userinfo: {},
                visible: false
            }
        },
        methods: {
            getUsersList() {
                let _this = this;
                this.$get(this.$tools.getUsersList).then((res) => {
                    _this.users_list = res.data
                })
            },
            edituser(user_id) {
                this.userinfo = {
                    'user_id': user_id,
                    'title': '修改用户'
                };
                this.$refs.childUserinfo.childFun(this.userinfo);
            },
            editpass(user_id) {
                this.$refs.childPassword.childFun(user_id);
            },
            adduser() {
                this.$refs.childUser.childFun();
            },
            deluser(userinfo) {
                var vm = this;
                this.$delete(this.$tools.delUsers + userinfo.id).then((res) => {
                    if (res.code === 200) {
                        vm.$message({message: '修改成功', type: 'success'});
                        vm.reload();
                    } else {
                        vm.$message.error({message: res.msg});
                    }
                })
            },
            refresh() {
                this.reload();
            },
        },
        created() {
            this.getUsersList();
        }
    }
</script>
