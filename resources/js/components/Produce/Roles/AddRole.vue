<template>
    <div>
        <el-dialog title="新增角色" :visible.sync="addrole" width="60%" @close="resetForm">
            <el-form label-width="80px" :model="roleform" ref="roleform" size="small"
                     :rules="rules">
                <el-form-item label="名称" prop="name">
                    <el-input placeholder="请输入名称" v-model="roleform.name"></el-input>
                </el-form-item>
                <el-form-item label="角色" prop="slug">
                    <el-input placeholder="请输入角色" v-model="roleform.slug"></el-input>
                </el-form-item>
                <el-form-item label="菜单名称" prop="menus">
                    <el-checkbox-group v-model="roleform.menus">
                        <template v-for="me in menu">
                            <el-form-item>
                                <el-checkbox class="el-checkbox" font-weight="bold" :label="me.id" :key="me.id">
                                    {{ me.title }}
                                </el-checkbox>
                                <br/>
                            </el-form-item>
                            <template v-if="me.children.length>0">
                                <template v-for="m in me.children">
                                    <el-divider direction="vertical"></el-divider>
                                    <el-checkbox class="el-checkbox" :label="m.id" :key="m.id">{{ m.title }}
                                    </el-checkbox>
                                    <br/>
                                </template>
                            </template>
                            <el-divider></el-divider>
                        </template>
                    </el-checkbox-group>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="resetForm">重置</el-button>
                <el-button @click="addrole = false">取 消</el-button>
                <el-button type="primary" @click="addroles">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddRole",
        inject: ['reload'],
        data() {
            return {
                addrole: false,
                menu: [],
                roleform: {
                    name: '',
                    slug: '',
                    menus: [],
                },
                rules: {},
            }
        },
        methods: {
            addroles() {
                var _this = this;
                this.$post(this.$produce.addRoles, {
                    name: this.roleform.name,
                    slug: this.roleform.slug,
                    menus_list: this.roleform.menus,
                }).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '添加成功', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg})
                    }
                })
            },
            childFun(menu) {
                this.addrole = true;
                this.menu = menu;
            },
            resetForm() {
                this.$refs['roleform'].resetFields();
            }
        },
    }
</script>

<style scoped>
    .el-checkbox {
        font-weight: bold;
        font-size: 16px;
    }
</style>