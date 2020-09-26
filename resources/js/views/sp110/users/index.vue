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
            <el-table-column label="角色">
                <template slot-scope="scope">
                            <span>
                                <el-tag v-for="(v,k) in scope.row.roles" :key="k">{{v.name}}</el-tag>
                            </span>
                </template>
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
                    label="操作"
                    min-width="150px"
            >
                <template slot-scope="scope" v-if="scope.row.username != 'admin'">
                    <el-button type="primary" size="small" @click="editrole(scope.row.id)">编辑角色</el-button>
                    <el-button @click="editpsw(scope.row.id)" size="small">修改密码</el-button>
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
        <add-user ref="childUser"></add-user>

        <!--修改密码-->
        <change-password ref="childPassword"></change-password>

        <!--修改用户-->
        <edit-userinfo ref="childUserinfo"></edit-userinfo>

        <!--修改角色-->
        <change-roles ref="childRoles"></change-roles>
    </div>
</template>

<script>
    import AddUser from "@/components/Sp110/Users/AddUser";
    import EditUserinfo from "@/components/Sp110/Users/EditUserinfo";
    import ChangePassword from "@/components/Sp110/Users/ChangePassword";
    import ChangeRoles from "@/components/Sp110/Users/ChangeRoles";

    export default {
        name: "index",
        inject: ['reload'],
        components: {
            AddUser,
            ChangePassword,
            EditUserinfo,
            ChangeRoles,
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
            get_users_list() {
                let _this = this;
                this.$get(this.$sp110.getUsersList).then((res) => {
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
            editpsw(user_id) {
                this.$refs.childPassword.childFun(user_id);
            },
            editrole(user_id) {
                this.$refs.childRoles.childFun(user_id);
            },
            adduser() {
                this.$refs.childUser.childFun();
            },
            deluser(userinfo) {
                var vm = this;
                this.$delete(this.$sp110.delUsers + userinfo.id).then((res) => {
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
            this.get_users_list();
        }
    }
</script>

<style>
    .el-tag {
        margin: 0 3px;
    }
</style>
