<template>
    <el-aside :width="leftBarWidth">
        <el-scrollbar>
            <el-menu
                    class="el-menu-vertical-demo"
                    router
                    background-color="#545c64"
                    text-color="#bfcbd9"
                    active-text-color="#409EFF"
                    :collapse="isCollapse">
                <el-menu-item index="/sp110/index" route="/sp110/index">
                    <i class="icon el-icon-s-home"></i>
                    <span slot="title">系统首页</span>
                </el-menu-item>
                <navigation-item v-for="menu in menuList" :key="menu.id" :item="menu"/>
            </el-menu>
        </el-scrollbar>
    </el-aside>
</template>
<script>
    import navigationItem from "./navigationItem";

    export default {
        name: 'navigation',
        components: {navigationItem},
        data() {
            return {
                isCollapse: false,
                leftBarWidth: "200px",
            }
        },
        props: {
            menuList: {
                type: Array,
                required: true
            }
        },
        methods: {
            childFun() {
                this.isCollapse = !this.isCollapse;
                if (this.isCollapse) {
                    this.leftBarWidth = "65px";
                } else {
                    this.leftBarWidth = "200px";
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
        height: 100%;
    }

    .el-menu {
        border-right: none;
        height: 100%;

        .el-submenu__title i {
            color: #e1e1e1;
        }

        .title_i {
            color: #cfcfcf;
            padding-right: 15px;
        }
    }

    .el-scrollbar {
        height: 100%;
    }

    .el-aside {
        height: 100%;
        overflow: hidden !important;
    }

    .icon {
        font-size: 22px;
    }


    .el-scrollbar__wrap {
        overflow-x: hidden !important;


        .main_in2 {
            padding: 25px;
        }
    }
</style>

<style lang="scss">
    .el-scrollbar__wrap {
        overflow: hidden;
        margin-right: 0 !important;

        .el-scrollbar__view {
            height: 100%;
        }
    }
</style>
