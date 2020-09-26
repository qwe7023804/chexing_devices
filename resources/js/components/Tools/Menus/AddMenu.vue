<template>
    <div>
        <el-dialog title="新增目录" :visible.sync="addmenu" width="30%" @close="resetForm">
            <el-form label-width="80px" :model="menuform" ref="menuform" size="small"
                     :rules="rules">
                <el-form-item label="选择菜单" prop="parent_id">
                    <el-cascader
                            props.checkStrictly=true
                            v-model='menuform.parent_id'
                            :options="menus_list"
                            :props="defaultParams"
                            clearable
                    >
                    </el-cascader>
                </el-form-item>
                <el-form-item label="菜单名称" prop="menuname">
                    <el-input placeholder="请输入菜单" v-model="menuform.menuname"></el-input>
                </el-form-item>
                <el-form-item label="默认路径" prop="uri">
                    <el-input placeholder="默认路径" v-model="menuform.uri"></el-input>
                </el-form-item>
                <el-form-item label="选择图标" prop="icon">
                    <e-icon-picker v-model="menuform.icon" :options="options" :disabled="disabled" :readonly="readonly"
                                   :placement="placement" :styles="style" :width="width"/>
                    {{icon}}
                </el-form-item>
                <el-form-item label="权限标识" prop="perms">
                    <el-input v-model="menuform.perms"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="resetForm">重置</el-button>
                <el-button @click="addmenu = false">取 消</el-button>
                <el-button type="primary" @click="addmenus('menuform')">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddMenu",
        inject: ['reload'],
        data() {
            return {
                addmenu: false,
                menus_list: [],
                defaultParams: {
                    checkStrictly: true,
                    label: 'title',
                    value: 'id',
                },
                menuform: {
                    parent_id: '',
                    menuname: '',
                    icon: '',
                    uri: '/',
                    perms: '',
                },
                icon: '',
                options: {FontAwesome: false, ElementUI: true, addIconList: ['fa fa-slack'], removeIconList: []},
                disabled: false,
                readonly: false,
                placement: 'bottom',
                style: {},
                width: 800,
                rules: {
                    parent_id: [{required: true, message: '请选择菜单'}],
                    icon: [{required: true, message: '请选择图标'}],
                    menuname: [{required: true, message: '请输入标题'},
                        {min: 2, max: 8, message: '长度2-8个字符'}],
                    uri: [{required: true, message: '请输入路径'},
                        {min: 1, max: 30, message: '长度2-30个字符'}],
                },
            }
        },
        methods: {
            childFun(menus_list) {
                this.addmenu = true;
                this.getTreeData(menus_list);
            },
            getTreeData(data) {
                let mylist = [];
                // 循环遍历json数据
                for (var i = 0; i < data.length; i++) {

                    if (data[i].children.length < 1) {
                        // children若为空数组，则将children设为undefined
                        data[i].children = undefined;
                    } else {
                        // children若不为空数组，则继续 递归调用 本方法
                        this.getTreeData(data[i].children);
                    }
                    mylist.push(data[i]);
                }
                mylist.unshift({
                    id: 0,
                    title: '无'
                })
                this.menus_list = mylist;
            },
            addmenus(menuform) {
                this.$refs.menuform.validate((valid) => {
                    if (valid) {
                        var _this = this;
                        this.$post(this.$tools.addMenus, {
                            parent_id: this.menuform.parent_id,
                            menuname: this.menuform.menuname,
                            icon: this.menuform.icon,
                            uri: this.menuform.uri,
                            perms: this.menuform.perms
                        }).then((res) => {
                            if (res.code === 200) {
                                _this.$message({message: '添加成功！', type: "success"});
                                _this.reload();
                            } else {
                                _this.$message.error({message: res.msg})
                            }
                        })
                    } else {
                        return false;
                    }
                })
            },
            resetForm() {
                this.$refs['menuform'].resetFields();
            },
        },
    }
</script>

<style scoped>

</style>