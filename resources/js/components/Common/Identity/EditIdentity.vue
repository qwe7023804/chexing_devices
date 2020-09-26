<template>
    <div>
        <el-dialog title="修改身份" :visible.sync="editidentity" width="30%" @close="resetForm">
            <el-form label-width="80px" :model="identityform" ref="identityform" size="small"
                     :rules="rules">
                <el-form-item label="身份信息" prop="name">
                    <el-input placeholder="请输入身份信息" v-model="identityform.name"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="editidentity = false">取 消</el-button>
                <el-button type="primary" @click="updateidentity">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "EditIdentity",
        inject: ['reload'],
        data() {
            return {
                editidentity: false,
                id: '',
                identityform: {
                    name: '',
                },
                rules: {
                    name: [
                        {required: true, message: '请输入身份信息', trigger: 'blur'},
                        {min: 1, max: 10, message: '长度1-10个字符', trigger: 'blur'}
                    ],
                },
            }
        },
        methods: {
            updateidentity() {
                var _this = this;
                this.$patch(this.$sp110.updateIdentity + this.id, {
                    name: this.identityform.name,
                }).then((res) => {
                    if (res.code === 200) {
                        _this.$message({message: '修改成功！', type: 'success'});
                        _this.reload();
                    } else {
                        _this.$message.error({message: res.msg})
                    }
                })
            },
            childFun(info) {
                this.editidentity = true;
                this.id = info.id;
                this.identityform.name = info.name;
            },
            resetForm() {
                this.$refs['identityform'].resetFields();
            }
        },
    }
</script>
