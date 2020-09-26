<template>
    <block v-if="item.children">
        <template v-if="item.children.length == 0">
            <el-menu-item :index="item.uri">
                <i :class="'icon '+item.icon"></i>
                <span slot="title">{{item.title}}</span>
            </el-menu-item>
        </template>
        <el-submenu v-else :index="item.uri" :key="item.id">
            <template slot="title">
                <i :class="'icon ' + item.icon"></i>
                <span slot="title">{{item.title}}</span>
            </template>
            <el-menu-item-group>
                <template v-for="child in item.children">

                    <navigation-item v-if="child.children&&child.children.length>0"
                                     :item="child"
                                     :key="child.id"/>
                    <el-menu-item v-else :key="child.id" :index="child.uri">
                        {{child.title}}
                    </el-menu-item>

                </template>
            </el-menu-item-group>
        </el-submenu>
    </block>
</template>

<script>
    export default {
        name: 'navigationItem',
        props: {
            item: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style>
    .icon {
        font-size: 22px;
    }
</style>