<template>
    <div>
        <el-dialog :title="title" :visible.sync="onemenu" width="20%">
            <el-form label-width="40px"
            >
                <draggable v-model="menus"
                           :options="{animation:500}">
                    <transition-group>
                        <el-col v-for="(menu, index) in menus" :key="menu.id">
                            <el-card shadow="hover">
                                <el-form-item :label="index+1+''">
                                    <span>{{ menu.title }}</span>
                                    <i class="el-icon-caret-top"></i>
                                </el-form-item>
                            </el-card>
                        </el-col>
                    </transition-group>
                </draggable>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="onemenu = false">取 消</el-button>
                <el-button type="primary" @click="updatemenus">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        name: "DirectorySort",
        components: {
            draggable,
        },
        inject: ['reload'],
        data() {
            return {
                onemenu: false,
                title: '',
                menus: [],
            }
        },
        methods: {
            uponemenus(onemenus) {
            },
            childFun(info) {
                this.onemenu = true;
                this.title = info.title;
                this.get_menus(info.parent_id);
            },
            get_menus(parent_id) {
                var _this = this;
                this.$post(this.$tools.getSortMenus, {
                    parent_id: parent_id,
                }).then((res) => {
                    if (res.code === 200) {
                        _this.menus = res.data;
                    } else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },
            updatemenus() {
                var _this = this;
                for (let a = 0; a < this.menus.length; a++) {
                    this.menus[a].order = a + 1;
                }
                this.$post(this.$tools.updateSortMenus, {
                    menus_list: this.menus
                }).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '修改成功！', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },

        },
        mounted() {
            //为了防止火狐浏览器拖拽的时候以新标签打开，此代码真实有效
            document.body.ondrop = function (event) {
                event.preventDefault();
                event.stopPropagation();
            }
        }
    }
</script>

<style lang="scss">

    .el-card{
        margin-bottom: 10px;
    }
    .el-card__body{
        padding: 0 20px;
    }

    /*.el-form-item{*/
    /*    margin-bottom: 0 !important;*/
    /*}*/
</style>

<style scoped>
    .el-form-item{
        margin-bottom: 0 ;
    }
</style>
