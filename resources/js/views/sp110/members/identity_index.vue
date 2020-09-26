<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-button type="primary" icon="el-icon-plus" @click="addidentity">添加身份</el-button>
            </el-col>
        </el-row>

        <el-table
                :data="identity_list"
                border
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="ID"
            >
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="身份信息"
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
                    <el-button type="primary" size="small" @click="editidentity(scope.row)">编辑</el-button>
                    <el-popconfirm
                            confirmButtonText='删除'
                            cancelButtonText='取消'
                            confirmButtonType="danger"
                            icon="el-icon-info"
                            placement="left-end"
                            iconColor="red"
                            title="是否删除此信息？"
                            @onConfirm="delidentity(scope.row.id)"
                    >
                        <el-button style="margin-left: 10px" type="danger" size="small" slot="reference">删除</el-button>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>

        <!--添加身份-->
        <add-identity ref="childIdentity"></add-identity>
        <!--修改身份-->
        <edit-identity ref="childEditIdentity"></edit-identity>
    </div>
</template>

<script>
    import AddIdentity from "@/components/Common/Identity/AddIdentity";
    import EditIdentity from "@/components/Common/Identity/EditIdentity";

    export default {
        name: "identity_index",
        inject: ['reload'],
        components: {
            AddIdentity,
            EditIdentity,
        },
        data() {
            return {
                identity_list: [],
            }
        },
        methods: {
            get_identiy() {
                var _this = this;
                this.$get(this.$sp110.getIdentity).then(res => {
                        if (res.code === 200) {
                            _this.identity_list = res.data;
                        } else {
                            _this.$message.error({message: '系统错误'});
                        }
                    }
                )
            },
            addidentity() {
                this.$refs.childIdentity.childFun();
            },
            editidentity(info) {
                this.$refs.childEditIdentity.childFun(info);
            },
            delidentity(id) {
                var _this = this;
                this.$delete(this.$sp110.delIdentity + id).then(res => {
                    if (res.code === 200) {
                        _this.$message({message: '删除成功！', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg});
                    }
                })
            },
        },
        created() {
            this.get_identiy()
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
