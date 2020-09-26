<template>
    <div class="homepage-hero-module">
        <div class="video-container">
            <div :style="fixStyle" class="filter"></div>
            <video :style="fixStyle" autoplay loop class="fillWidth" v-on:canplay="canplay" muted=“muted”>
                <!--                <source src="https://sp150.16d1.com/st.mp4" type="video/mp4"/>-->
                <source :src="PATH_TO_MP4" type="video/mp4"/>
                浏览器不支持 video 标签，建议升级浏览器。
                <source :src="PATH_TO_WEBM" type="video/webm"/>
                浏览器不支持 video 标签，建议升级浏览器。
            </video>
            <div class="poster hidden" v-if="!vedioCanPlay">
                <img :src="PATH_TO_JPEG">
            </div>
            <div class="login-container">
                <el-form label-position="left" ref="loginForm" :rules="rules"
                         class="login-box">
                    <div class="login-title">
                        <h2>车行天下设备后台管理系统</h2>
                        <em style="font-size: 0.8em">CheXingTianXia Deviecs Management System</em>
                    </div>
                    <el-form-item prop="username">
                        <el-input placeholder="请输入账号" v-model="username" @keyup.enter.native="login">
                            <i slot="prefix" class="iconfont icon-geren1"></i>
                        </el-input>
                    </el-form-item>
                    <el-form-item prop="password">
                        <el-input type="password" placeholder="请输入密码" v-model="password"
                                  @keyup.enter.native="login">
                            <i slot="prefix" class="iconfont icon-mima"></i>
                        </el-input>
                    </el-form-item>
                    <el-button type="primary" @click="login" style="width: 100%">登录</el-button>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "login",
        data() {
            screenWidth: document.body.clientWidth
            return {
                // 对话框显示和隐藏
                vedioCanPlay: false,
                fixStyle: '',
                username: '',
                password: '',

                PATH_TO_MP4: require("../../static/ttt.mp4"),
                PATH_TO_WEBM: '',
                PATH_TO_JPEG: '',
                // 表单验证，需要在 el-form-item 元素中增加 prop 属性
                rules: {
                    username: [
                        {required: true, message: '账号不可为空', trigger: 'blur'},
                        {min: 3, max: 20, message: '长度3-20个字符', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                        {min: 6, max: 20, message: '长度6-20个字符', trigger: 'blur'}
                    ]
                },
            }
        },
        methods: {
            canplay() {
                this.vedioCanPlay = true
            },
            login: function () {
                var vm = this;
                if (this.username == "" || this.password == "") {
                    this.$message.error("用户名和密码不能为空！");
                    return;
                }
                this.$post(this.$produce.login, {
                    username: this.username,
                    password: this.password
                }).then((res) => {
                    if (res.code == 200) {
                        // console.log(res);
                        // 存储用户的token
                        localStorage.setItem("token", res.token);
                        // localStorage.setItem('user_info', JSON.stringify(res.user_info));
                        localStorage.setItem('user_info', JSON.stringify(res.user_info.username));
                        vm.$message({message: "登录成功!", type: "success"});
                        vm.$router.push({name: "produce_default"});
                    } else {
                        vm.$message.error({message: res.msg});
                    }
                });
            }
        },
        created: function () {
            var _this = this;
            // 判断token是否失效
            this.$get(this.$produce.checkUserLogin).then((res) => {
                // console.log(res);
                if (res.code == 200) {
                    _this.$router.push({name: "produce_default"});
                }
            });
        },
        mounted: function () {
            window.onresize = () => {
                const windowWidth = document.body.clientWidth
                const windowHeight = document.body.clientHeight
                const windowAspectRatio = windowHeight / windowWidth
                let videoWidth
                let videoHeight
                if (windowAspectRatio < 0.5625) {
                    videoWidth = windowWidth
                    videoHeight = videoWidth * 0.5625
                    this.fixStyle = {
                        height: windowWidth * 0.5625 + 'px',
                        width: windowWidth + 'px',
                        'margin-bottom': (windowHeight - videoHeight) / 2 + 'px',
                        'margin-left': 'initial'
                    }
                } else {
                    videoHeight = windowHeight
                    videoWidth = videoHeight / 0.5625
                    this.fixStyle = {
                        height: windowHeight + 'px',
                        width: windowHeight / 0.5625 + 'px',
                        'margin-left': (windowWidth - videoWidth) / 2 + 'px',
                        'margin-bottom': 'initial'
                    }
                }
            }
            window.onresize()
        }
    }
</script>
<style rel="stylesheet/scss" lang="scss">
    $bg: #2d3a4b;
    $dark_gray: #889aa4;
    $light_gray: #eeeeee;

    .login-box {
        width: 350px;
        margin: 10% auto 0 auto;
        padding: 35px 35px 35px 35px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        box-shadow: 0 0 25px #909399;
        background: rgba(255, 255, 255, 0.15);
    }

    .login-title {
        text-align: center;
        margin: 0 auto 20px auto;
        color: #ffffff;
    }

    .login-container {
        position: fixed;
        height: 100%;
        width: 100%;
        z-index: 9999;

        .el-input {
            input {
                background: transparent;
                border: 0px;
                -webkit-appearance: none;
                border-radius: 0px;
                color: $light_gray;

                &:-webkit-autofill {
                    box-shadow: 0 0 0px 1000px $bg inset !important;
                    -webkit-box-shadow: 0 0 0px 1000px $bg inset !important;
                    -webkit-text-fill-color: #fff !important;
                }
            }

        }

        .el-form-item {
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(64, 158, 255, 0.1);
            border-radius: 5px;
            color: rgb(255, 255, 255);

            .el-input--small{
                line-height: 45px;
                font-size: 15px;
            }
        }
        .el-input__inner{
            margin: 0 10px;
        }
        .iconfont{
            font-size: 18px;
            color: #909399;
        }
    }


</style>

<style scoped>

    .homepage-hero-module,
    .video-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .video-container .poster img,
    .video-container video {
        z-index: 0;
        position: absolute;
    }

    .video-container .filter {
        z-index: 1;
        position: absolute;
        background: rgba(0, 0, 0, 0.4);
    }
</style>
