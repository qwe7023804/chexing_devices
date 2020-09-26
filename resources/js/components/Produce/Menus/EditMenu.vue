<template>
    <div>
        <el-dialog title="修改目录" :visible.sync="editmenu" width="30%" @close="resetForm">
            <el-form label-width="80px" :data="menuform" :model="menuform" ref="menuform" size="small"
                     :rules="rules">
                <el-form-item label="菜单ID">
                    <el-input v-model="menuform.id" disabled></el-input>
                </el-form-item>
                <el-form-item label="菜单名称">
                    <el-input v-model="menuform.title"></el-input>
                </el-form-item>
                <el-form-item label="默认路径">
                    <el-input v-model="menuform.uri"></el-input>
                </el-form-item>
                <el-form-item label="选择图标">
                    <e-icon-picker v-model="menuform.icon" :options="options" :disabled="disabled" :readonly="readonly"
                                   :placement="placement" :styles="style" :width="width"/>
                    {{icon}}
                </el-form-item>
                <!--                <el-form-item label="权限标识" prop="perms">-->
                <!--                    <el-input v-model="menuform.perms"></el-input>-->
                <!--                </el-form-item>-->
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="resetForm">重置</el-button>
                <el-button @click="editmenu = false">取 消</el-button>
                <el-button type="primary" @click="editmenus()">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "EditMenu",
        inject: ['reload'],
        data() {
            return {
                editmenu: false,
                menuform: {
                    id:'',
                    icon: '',
                    uri: '',
                    perms: '',
                    title: '',
                },
                icon: '',
                options: {FontAwesome: false, ElementUI: true, addIconList: ['fa fa-slack'], removeIconList: []},
                disabled: false,
                readonly: false,
                placement: 'bottom',
                style: {},
                width: 800,
                rules: {
                    icon: [{required: true, message: '请选择图标'}],
                    title: [{required: true, message: '请输入标题'},
                        {min: 2, max: 8, message: '长度2-8个字符'}],
                    uri: [{required: true, message: '请输入路径'},
                        {min: 1, max: 30, message: '长度2-30个字符'}],
                }
            }
        },
        methods: {
            childFun(id) {
                this.getmeuu(id);
            },
            getmeuu(id) {
                var _this = this;
                this.$get(this.$produce.editMenus + id + '/edit').then((res) => {
                    _this.editmenu = true;
                    _this.menuform = res.data;
                })
            },
            editmenus() {
                var _this = this;
                this.$patch(this.$produce.updateMenus + this.menuform.id, {
                    title: this.menuform.title,
                    uri: this.menuform.uri,
                    icon:this.menuform.icon,
                }).then((res) => {
                    if (res.code === 200){
                        _this.$message({message:'修改成功！', type:'success'});
                        _this.reload();
                    }else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },
            resetForm() {
                this.$refs['menuform'].resetFields();
            },
        }
    }

</script>

<style scoped>

</style>