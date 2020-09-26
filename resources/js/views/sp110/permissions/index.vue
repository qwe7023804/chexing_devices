<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-button type="primary" icon="el-icon-plus" @click="addmenus">新增菜单</el-button>

                <el-button plain type="warning" icon="el-icon-sort" @click="directorysort({title:'一级目录排序', order:'1'})">
                    目录排序
                </el-button>
            </el-col>
        </el-row>
        <el-table
                :data="permissions_list"
                style="width: 100%"
                row-key="id"
                lazy
                :tree-props="{children: 'children', hasChildren: 'hasChildren'}">
            <el-table-column
                    prop="title"
                    label="名称">
            </el-table-column>
            <el-table-column
                    prop="controller_action"
                    label="权限标识">
            </el-table-column>
            <el-table-column
                    prop="order"
                    label="排序">
            </el-table-column>
<!--            <el-table-column-->
<!--                    prop="level"-->
<!--                    label="级别">-->
<!--            </el-table-column>-->
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button
                            type="primary"
                            size="mini"
                            @click="directoryEdit(scope.row.id)">编辑
                    </el-button>
                    <el-popconfirm
                            confirmButtonText='删除'
                            cancelButtonText='取消'
                            confirmButtonType="danger"
                            icon="el-icon-info"
                            placement="left-end"
                            iconColor="red"
                            title="是否删除此菜单？"
                            @onConfirm="directoryDelete(scope.row.id)"
                    >
                        <el-button style="margin-left: 10px" type="danger" size="small" slot="reference">删除</el-button>
                    </el-popconfirm>
                    <template v-if="scope.row.uri === '/'">
                        <el-button
                                plain
                                type="warning"
                                size="mini"
                                @click="directorysort({title:'二级目录排序',parent_id:scope.row.id})">目录排序
                            <i class="el-icon-sort"></i>
                        </el-button>
                    </template>
                </template>
            </el-table-column>
        </el-table>


<!--        &lt;!&ndash;添加菜单&ndash;&gt;-->
<!--        <add-menu ref="childMenu"></add-menu>-->
<!--        &lt;!&ndash;目录排序&ndash;&gt;-->
<!--        <directory-sort ref="childSortMenu"></directory-sort>-->
<!--        &lt;!&ndash;修改菜单信息&ndash;&gt;-->
<!--        <edit-menu ref="childEditMenu"></edit-menu>-->
    </div>
</template>

<script>
    export default {
        name: "index",
        data() {
            return {
                permissions_list: []
            }
        },
        methods: {
            get_permission_list() {
                let _this = this;
                this.$get(this.$sp110.getPermissionList).then((res) => {
                    _this.permissions_list = res.data;
                })
            },
            addmenus() {
                this.$refs.childMenu.childFun(this.menus_list);
            },
            directoryEdit(id) {
                this.$refs.childEditMenu.childFun(id);
            },
            directoryDelete(id) {
                var _this = this;
                this.$delete(this.$sp110.delMenus + id).then((res) => {
                    if (res.code === 200){
                        _this.$message({message: '删除成功！', type: 'success'});
                        _this.reload();
                    }else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },
            directorysort(title) {
                this.$refs.chilSortMenu.childFun(title);
            },
            refresh() {
                this.reload();
            },
        },
        created() {
            this.get_permission_list();
        }
    }
</script>

<style scoped>

</style>