<template>
    <div>
        <el-dialog title='编辑角色' :visible.sync="editrole" width="40%" @close="resetForm">
            <el-form :data="roleform" :model="roleform" ref="roleform" :rules="rules">
                <el-form-item label="菜单名称" prop="menus">
                    <el-checkbox-group v-model="roleform.menus">
                        <template v-for="me in menu">
                            <el-checkbox class="el-checkbox" font-weight="bold" :label="me.id"
                                         :key="me.id" border>
                                {{ me.name }}
                            </el-checkbox>
                            <br/>
                        </template>
                    </el-checkbox-group>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <div slot="footer" class="dialog-footer">
                    <el-button @click="editrole = false">取 消</el-button>
                    <el-button type="primary" @click="updateUser('roleform')">确 定</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "ChangeRoles",
        inject: ['reload'],
        data() {
            return {
                editrole: false,
                user_id: '',
                roleform: {
                    menus: [],
                },
                menu: [],
                rules: {},
            }
        },
        methods: {
            childFun(user_id) {
                this.user_id = user_id;
                this.editrole = true;
                this.edituserroles();
            },
            edituserroles() {
                this.$get(this.$sp110.getRolesUser + this.user_id).then((res) => {
                        if (res.code === 200) {
                            this.menu = res.data.list;
                            if (res.data.is === 1) {
                                this.roleform.menus = res.data.info;
                            }
                        } else {
                            this.$message.error({message: '获取失败！'});
                        }
                    }
                )
            },
            updateUser() {
                let _this = this;
                this.$patch(this.$sp110.updateRolesUser + this.user_id, {
                    roles_list: this.roleform.menus,
                }).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '修改成功', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg})
                    }
                })
            },
            resetForm() {
                this.$refs['roleform'].resetFields();
            }
        }
    }
</script>

<style scoped>

</style>