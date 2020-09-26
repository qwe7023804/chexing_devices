<template>
    <!--   外层容器    -->
    <el-container>
        <!--        左侧导航-->
        <el-aside :width="leftBarWidth">
            <el-menu class="el-menu-vertical-demo" background-color="#545c64"
                     text-color="#fff" active-text-color="#409EFF"
                     router :default-active="$route.path"
                     :collapse="isCollapse">
                <el-menu-item index="/produce/index" route="/produce/index">
                    <i class="el-icon-s-home"></i>
                    <span slot="title">系统首页</span>
                </el-menu-item>
                <template v-for="v in premisssion_menus">
                    <el-menu-item v-if="v.children.length === 0" :index="v.uri">
                        <i :class="v.icon"></i>
                        <span slot="title">{{ v.title }}</span>
                    </el-menu-item>
                    <el-submenu v-else :index="v.id+''" :key="v.id">
                        <template slot="title">
                            <i :class="v.icon"></i>
                            <span slot="title">{{v.title}}</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item v-for="vo in v.children" :index="vo.uri" :key="vo.id+''">{{ vo.title }}
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>
                </template>
            </el-menu>
        </el-aside>
        <!--   外层容器    -->
        <el-container>
            <!-- 顶栏容器-->
            <el-header height="50">
                <div class="index_top_bg">
                    <div class="index_header">
                        <div style="padding: 0 15px" class="hamburger-container" @click="left_bar">
                            <svg class="hamburger" viewBox="0 0 1024 1024"
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="64" height="64">
                                <path d="M408 442h480c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H408c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8zm-8 204c0 4.4 3.6 8 8 8h480c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H408c-4.4 0-8 3.6-8 8v56zm504-486H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0 632H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zM142.4 642.1L298.7 519a8.84 8.84 0 0 0 0-13.9L142.4 381.9c-5.8-4.6-14.4-.5-14.4 6.9v246.3a8.9 8.9 0 0 0 14.4 7z"/>
                            </svg>
                        </div>

                        <breadcrumb id="breadcrumb-container" class="breadcrumb-container"/>
                    </div>
                    <div class="right-menu">
                        <div class="right-menu-item hover-effect">
                            <i class="el-icon-refresh " @click="$router.go(0)"></i>
                        </div>
                        <div class="right-menu-item">
                            <div class="avatar"><img
                                    :src="user_info.avatar||'https://www.layui.com/admin/pro/dist/style/res/template/portrait.png'">
                            </div>
                        </div>
                        <div class="right-menu-item">
                            <el-dropdown @command="handleCommand">
                                <span class="el-dropdown-link">
                                {{user_info.name}}<i class="el-icon-arrow-down el-icon--right"></i>
                                </span>
                                <el-dropdown-menu class="head_menu" slot="dropdown">
                                    <el-dropdown-item>修改密码</el-dropdown-item>
                                    <el-dropdown-item command="logout" divided>退出</el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </div>
                    </div>
                </div>
                <!--                <breadcrumb-nav></breadcrumb-nav>-->
            </el-header>
            <!-- 主要区域容器-->
            <el-main class="main_in">
                <el-scrollbar>
                    <div class="main_in2">
                        <transition name="el-fade-in-linear" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </div>
                </el-scrollbar>
            </el-main>
            <!-- 底栏容器-->

        </el-container>
        <!--        <el-footer>Footer</el-footer>-->
    </el-container>
</template>

<script>
    import Breadcrumb from "@/components/Common/Breadcrumb";

    export default {
        name: "index",
        components: {
            Breadcrumb,
        },
        data() {
            return {
                isCollapse: false,
                leftBarWidth: "200px",
                user_info: {},
                premisssion_menus: [],
            }
        },
        methods: {
            handleCommand: function (e) {
                // 点击退出
                if (e == 'logout') {
                    this.logout();
                }
            },
            left_bar() {
                this.isCollapse = !this.isCollapse;
                if (this.isCollapse) {
                    this.leftBarWidth = "65px";
                    this.isQingwu = false;
                } else {
                    this.leftBarWidth = "200px";
                    this.isQingwu = true;
                }
            },
            logout() {
                let _this = this;
                this.$get(this.$produce.logout).then(function () {
                    localStorage.removeItem('token');
                    _this.$router.push('/produce/login');
                });
            },
            get_user_info() {
                let _this = this;
                this.$get(this.$produce.getUserInfo).then((res) => {
                    _this.user_info = res.data;
                });
            },
            get_permission_menus() {
                let _this = this
                this.$get(this.$produce.getPermissionMenus).then((res) => {
                    _this.premisssion_menus = res.data;
                });
            }
        },
        created() {
            this.get_permission_menus();
            this.get_user_info();
        },
    }
</script>

<style lang="scss" scoped>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }

    .el-main {
        background-color: #f3f3f4;

        .el-scrollbar {
            height: 100%;
            background-color: #ffffff;
            padding: 20px;
            overflow: hidden;

        }
    }

    .main_in {
        height: calc(100% - 101px);
        background: #f3f3f4;
        width: 100%;
        box-sizing: border-box;

        .main_in2 {
            padding: 25px;
        }
    }

    .el-menu {
        border-right: none;
        height: 100%;
        background-color: #304156;

        .el-submenu__title i {
            color: #e1e1e1;
        }


        .title_i {
            color: #cfcfcf;
            background-color: #304156;
            padding-right: 15px;
        }
    }


    .el-aside {
        height: 100%;
        overflow: hidden !important;

    }

    .el-container {
        height: 100%;
    }

    .el-header {
        padding: 0;
    }

    .head_logo {
        height: 50px;
        line-height: 50px;
        text-align: center;
        font-size: 20px;
        background: #000;
        color: #fff;

        span {
            color: #409EFF;
        }
    }

    .index_top_bg {
        border-bottom: 1px solid #e7eaec !important;
        height: 50px;

        .index_header {
            float: left;
            color: #333;
            height: 50px;
        }

        .avatar img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            float: right;
            margin-top: 10px;
        }

        .right_head_other {
            float: right;
            margin-right: 40px;
            position: relative;
        }

        .hamburger-container {
            line-height: 50px;
            height: 100%;
            float: left;
            cursor: pointer;
            transition: background .3s;
            -webkit-tap-highlight-color: transparent;

            &:hover {
                background: rgba(0, 0, 0, .025)
            }

            .hamburger {
                display: inline-block;
                vertical-align: middle;
                width: 20px;
                height: 20px;
            }

            .hamburger.is-active {
                transform: rotate(180deg);
            }
        }

        .right-menu {
            float: right;
            height: 100%;
            line-height: 50px;

            &:focus {
                outline: none;
            }

            .right-menu-item {
                display: inline-block;
                padding: 0 8px;
                height: 100%;
                font-size: 18px;
                color: #5a5e66;
                vertical-align: text-bottom;

                &.hover-effect {
                    cursor: pointer;
                    transition: background .3s;

                    &:hover {
                        background: rgba(0, 0, 0, .025)
                    }
                }
            }
        }
    }
</style>

<style lang="scss">
    .el-scrollbar__wrap {
        overflow: hidden;
        margin-right: 0 !important;
    }

    .el-row {
        margin-bottom: 20px;

        & :last-child {
            margin-bottom: 0;
        }
    }

</style>