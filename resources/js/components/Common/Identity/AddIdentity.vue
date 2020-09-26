<template>
    <div>
        <el-dialog title="新增身份" :visible.sync="addidentity" width="20%" @close="resetForm">
            <el-form label-width="80px" :model="identityform" ref="identityform" size="small"
                     :rules="rules">
                <el-form-item label="身份信息" prop="name">
                    <el-input placeholder="请输入身份信息" v-model="identityform.name"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="resetForm">重置</el-button>
                <el-button @click="addidentity = false">取 消</el-button>
                <el-button type="primary" @click="identitys">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddIdentity",
        inject: ['reload'],
        data() {
            return {
                addidentity: false,
                identityform: {
                    name: '',
                },
                rules: {},
            }
        },
        methods: {
            identitys() {
                var _this = this;
                this.$post(this.$sp110.addIdentity, {
                    name: this.identityform.name,
                }).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '添加成功', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg})
                    }
                })
            },
            childFun() {
                this.addidentity = true;
            },
            resetForm() {
                this.$refs['identityform'].resetFields();
            }
        },
    }
</script>
