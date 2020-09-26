<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-button type="primary" icon="el-icon-plus" @click="addrole">添加角色</el-button>
            </el-col>
        </el-row>

        <el-table
                :data="roles_list"
                border
                style="width: 100%">
            <el-table-column
                    width="60px"
                    prop="id"
                    label="ID"
            >
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
            >
            </el-table-column>
            <el-table-column
                    prop="slug"
                    label="角色"
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
                    label="操作"
            >
                <template slot-scope="scope">
                    <el-button type="primary" size="small" @click="editrole(scope.row.id)">编辑</el-button>
                    <el-popconfirm
                            confirmButtonText='删除'
                            cancelButtonText='取消'
                            confirmButtonType="danger"
                            icon="el-icon-info"
                            placement="left-end"
                            iconColor="red"
                            title="是否删除此角色？"
                            @onConfirm="delrole(scope.row.id)"
                    >
                        <el-button style="margin-left: 10px" type="danger" size="small" slot="reference">删除</el-button>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>

        <add-role ref="childRole"></add-role>

        <edit-role ref="childEditRole"></edit-role>
    </div>
</template>

<script>
    import AddRole from "@/components/Sp110/Roles/AddRole";
    import EditRole from "@/components/Sp110/Roles/EditRole";

    export default {
        name: "index",
        inject: ['reload'],
        components: {
            AddRole,
            EditRole,
        },
        data() {
            return {
                menu: [],
                roles_list: []
            }
        },
        methods: {
            get_roles_list: function () {
                let _this = this;
                this.$get(this.$sp110.getRolesList).then((res) => {
                    _this.roles_list = res.data;

                })
            },
            addrole() {
                this.$refs.childRole.childFun(this.menu);
            },
            editrole(id) {
                this.$refs.childEditRole.childFun(this.menu, id);
                console.log(this.menu)
            },
            delrole(id) {
                var _this = this;
                this.$delete(this.$sp110.delIdentity + id).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '删除成功！', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },
            getMenu() {
                var _this = this;
                this.$get(this.$sp110.getMenusList).then((res) => {
                    if (res.code === 200) {
                        _this.menu = res.data;
                    } else {
                        _this.$message.error({message: '系统错误'});
                    }
                })
            },
        },
        created() {
            this.get_roles_list();
            this.getMenu()
        }
    }
</script>

<style lang="scss">
    .el-scrollbar__wrap {
        overflow: hidden;
    }

    .el-row {
        margin-bottom: 20px;

        & :last-child {
            margin-bottom: 0;
        }

    }

</style>
