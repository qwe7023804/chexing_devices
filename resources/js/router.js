import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [

        // sp110 后台
        {name: 'sp110_login', path: '/sp110/login', component: () => import('./views/sp110/login')},
        {name: 'sp110', path: '/sp110', component: () => import('./views/sp110/login')},

        {
            name: 'sp110_index', path: '/sp110/index', component: () => import('./views/sp110/index'), children: [
                {name: 'sp110_default', path: '/sp110/index', component: () => import('./views/sp110/default')},

                //菜单
                {
                    name: 'menus_index',
                    path: '/sp110/auth/menus',
                    component: () => import('./views/sp110/menus/index')
                },

                //角色

                {
                    name: 'roles_index',
                    path: '/sp110/auth/roles',
                    component: () => import('./views/sp110/roles/index')
                },

                //用户
                {
                    name: 'users_index',
                    path: '/sp110/auth/users',
                    component: () => import('./views/sp110/users/index')
                },

                //权限
                {
                    name: 'permissions_index',
                    path: '/sp110/auth/permissions',
                    component: () => import('./views/sp110/permissions/index')
                },

                //日志
                {
                    name: 'logs_index',
                    path: '/sp110/auth/logs',
                    component: () => import('./views/sp110/logs/index')
                },

                //会员信息
                {
                    name: 'members_index',
                    path: '/sp110/members/index',
                    component: () => import('./views/sp110/members/index')
                },

                //身份信息
                {
                    name: 'identity_index',
                    path: '/sp110/members/identity',
                    component: () => import('./views/sp110/members/identity_index')
                }
            ]
        },

        // tools 后台
        {name: 'tools_login', path: '/tools/login', component: () => import('./views/tools/login')},
        {name: 'tools', path: '/tools', component: () => import('./views/tools/login')},

        {
            name: 'tools_index', path: '/tools/index', component: () => import('./views/tools/index'), children: [
                {name: 'tools_default', path: '/tools/index', component: () => import('./views/tools/default')},

                //菜单
                {
                    name: 'tools_menus_index',
                    path: '/tools/auth/menus',
                    component: () => import('./views/tools/menus/index')
                },

                //角色

                {
                    name: 'tools_roles_index',
                    path: '/tools/auth/roles',
                    component: () => import('./views/tools/roles/index')
                },

                //用户
                {
                    name: 'tools_users_index',
                    path: '/tools/auth/users',
                    component: () => import('./views/tools/users/index')
                },

                //权限
                {
                    name: 'tools_permissions_index',
                    path: '/tools/auth/permissions',
                    component: () => import('./views/tools/permissions/index')
                },

                //日志
                {
                    name: 'tools_log',
                    path: '/tools/auth/logs',
                    component: () => import('./views/tools/logs/index')
                }
            ]
        },


        // produce 后台
        {name: 'produce_login', path: '/produce/login', component: () => import('./views/produce/login')},
        {name: 'produce', path: '/produce', component: () => import('./views/produce/login')},

        {
            name: 'produce_index', path: '/produce/index', component: () => import('./views/produce/index'), children: [
                {name: 'produce_default', path: '/produce/index', component: () => import('./views/produce/default')},

                //菜单
                {
                    name: 'produce_menus_index',
                    path: '/produce/auth/menus',
                    component: () => import('./views/produce/menus/index')
                },

                //角色

                {
                    name: 'produce_roles_index',
                    path: '/produce/auth/roles',
                    component: () => import('./views/produce/roles/index')
                },

                //用户
                {
                    name: 'produce_users_index',
                    path: '/produce/auth/users',
                    component: () => import('./views/produce/users/index')
                },

                //权限
                {
                    name: 'produce_permissions_index',
                    path: '/produce/auth/permissions',
                    component: () => import('./views/produce/permissions/index')
                },

                //日志
                {
                    name: 'produce_log',
                    path: '/produce/auth/logs',
                    component: () => import('./views/produce/logs/index')
                },

                // 操作员信息
                {
                    name: 'operators_index',
                    path: '/produce/operators/index',
                    component: () => import('./views/produce/operators/index')
                },

                //sp100库存
                {
                    name: 'sp100_stock',
                    path: '/produce/sp100/stock',
                    component:()=> import('./views/produce/sp100/stock')
                },

            ]
        },
    ]
})
