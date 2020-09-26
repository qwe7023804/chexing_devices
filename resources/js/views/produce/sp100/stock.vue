<template>
    <div>
        <el-form :inline="true">
            <el-form-item label="终端号">
                <el-input v-model="devsn" placeholder="终端号" @keyup.enter.native="handleSearch"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleSearch">查询</el-button>
            </el-form-item>
        </el-form>

        <el-table
                :data="stock_list"
                border
                tooltip-effect="dark"
                style="width: 100%">
            <el-table-column
                    prop="devsn"
                    label="终端号"
            >
            </el-table-column>
            <el-table-column
                    prop="operator.name"
                    label="操作员"
            >
            </el-table-column>
            <el-table-column
                    prop="status"
                    label="设备状态"
                    :formatter="authFormat"
            >
            </el-table-column>
            <el-table-column
                    prop="ctime"
                    label="入口时间"
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
        name: "stock",
        data() {
            return {
                stock_list: [],
                devsn: '',
                page: {
                    total: 0,
                    size: 15,
                    num: 1,
                    currentPage: 1,
                },
            }
        },
        methods: {
            getstock() {
                let _this = this;
                this.$get(this.$produce.getStock + '?page=' + this.page.num + '&devsn=' + this.devsn).then(res => {
                        if (res.code === 200) {
                            _this.stock_list = res.data.data;
                            _this.page.total = res.data.total;
                        } else {
                            _this.$message.error({message: res.msg});
                        }
                    }
                )
            },
            handleSearch() {
                this.getstock();
            },
            authFormat(row, column) {
                if (row.status === 1) {
                    return '正常'
                } else {
                    return '禁封'
                }
            },
            handleCurrentChange(val) {
                this.page.num = val;
                this.getstock();
            }
        },
        created() {
            this.getstock()
        },
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