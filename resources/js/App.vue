<template>
    <div id="apps">
        <router-view v-if="isShow"/>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                isShow: true
            }
        },
        provide() {
            return {
                reload: this.reload
            }
        },
        components: {},
        computed: {},
        methods: {
            reload() {
                this.isShow = false
                this.$nextTick(() => {
                    this.isShow = true
                })
            }
        },
        mounted() {
        },
    }

</script>
<style>
    html, body, #app, #apps {
        margin: 0;
        height: 100%;
    }

    body .el-table th.gutter {
        display: table-cell !important;
    }

    .icon {
        width: 1em;
        height: 1em;
        vertical-align: -0.15em;
        fill: currentColor;
        overflow: hidden;
    }
    .el-pagination{
        float: right;
    }
</style>
