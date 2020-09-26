<template>
    <div>
        <el-form :inline="true">
            <el-form-item label="手机号">
                <el-input v-model="userphone" placeholder="手机号" @keyup.enter.native="handleSearch"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleSearch">查询</el-button>
            </el-form-item>
        </el-form>

        <el-table
                :data="members_list"
                border
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    prop="userphone"
                    label="账号"
            >
            </el-table-column>
            <el-table-column
                    prop="username"
                    label="名称"
            >
            </el-table-column>
            <el-table-column
                    prop="auth"
                    label="账号状态"
                    :formatter="authFormat"
            >
            </el-table-column>
            <el-table-column
                    prop="ctime"
                    label="创建时间"
            >
            </el-table-column>
        </el-table>

        <div class="block">
            <el-pagination
                    @current-change="handleCurrentChange"
                    layout="total, prev, pager, next"
                    :page-size="page.size"
                    :total="page.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "index",
        data() {
            return {
                members_list: [],
                userphone: '',
                page: {
                    total: 0,
                    size: 15,
                    num: 1,
                    currentPage: 1,
                },

            }
        },
        methods: {
            get_mebers() {
                var _this = this;
                this.$get(this.$produce.getOperators + '?page=' + this.page.num + '&userphone=' + this.userphone).then(res => {
                        if (res.code === 200) {
                            _this.members_list = res.data.data;
                            _this.page.total = res.data.total;
                        } else {
                            _this.$message.error({message: '系统错误'});
                        }
                    }
                )
            },
            handleSearch() {
                this.get_mebers();
            },
            authFormat(row, column) {
                if (row.auth === 1) {
                    return '正常'
                } else {
                    return '禁封'
                }
            },
            handleCurrentChange(val) {
                this.page.num = val;
                this.get_mebers();
            }
        },
        created() {
            this.get_mebers()
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
