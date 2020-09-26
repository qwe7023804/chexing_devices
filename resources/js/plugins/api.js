export const baseUrl = "http://192.168.1.199/api/";

// export const baseUrl= "http://dev.16d1.com/api/";

export const sp110 = {
    "checkUserLogin": baseUrl + "Sp110/check_user_login", // 验证是否已经登录
    "login": baseUrl + "Sp110/login", // 登录
    "logout": baseUrl + "Sp110/logout", // 退出账号 注销
    'getUserInfo': baseUrl + "Sp110/user/get_user_info", // 获取用户信息
    // 'getUserList' : baseUrl + "Admin/users/index",
    //
    //
    // 获取后台权限栏目
    'getPermissionMenus': baseUrl + "Sp110/users/get_permission_menus",
    // 'getBreadNav' : baseUrl + "Admin/menus/get_bread_nav",
    //
    // 权限
    'getPermissionList' : baseUrl + "Sp110/permissions",
    // 'addHook' : baseUrl + "Admin/hooks/add",
    // 'editHook' : baseUrl + "Admin/hooks/edit/",
    // 'delHook' : baseUrl + "Admin/hooks/del",

    // 菜单API
    'getMenusList': baseUrl + "Sp110/menus",
    'addMenus': baseUrl + "Sp110/menus",
    'getSortMenus': baseUrl + "Sp110/menus/sortmenus",
    'updateSortMenus': baseUrl + "Sp110/menus/updatesortmenus",
    'editMenus': baseUrl + "Sp110/menus/",
    'delMenus': baseUrl + "Sp110/menus/",
    'updateMenus': baseUrl + "Sp110/menus/",


    // 角色API
    'getRolesList': baseUrl + "Sp110/roles",
    'addRoles': baseUrl + "Sp110/roles",
    'editRoles': baseUrl + "Sp110/roles/",
    'updateRoles': baseUrl + "Sp110/roles/",
    'delRoles': baseUrl + "Sp110/roles/",

    //
    // // 用户API
    'getUsersList': baseUrl + "Sp110/users",
    'addUsers': baseUrl + "Sp110/users",
    'editPassword': baseUrl + "Sp110/users/password",
    'editUsers': baseUrl + "Sp110/users/",
    'delUsers': baseUrl + "Sp110/users/",
    'updateUsers': baseUrl + "Sp110/users/",
    'getRolesUser': baseUrl + "Sp110/users/edit_user_role/",
    'updateRolesUser': baseUrl +"Sp110/users/update_user_role/",
    // 'getUserInfo' : baseUrl + "Admin/users/get_user_info", // 获取用户信息
    // 'adminChangeMoney' : baseUrl + "Admin/users/change_money", // 获取用户信息
    //
    // // 配置中心
    // 'webConfig' : baseUrl + "Admin/config/web_config", // 网址配置
    // 'uploadConfig' : baseUrl + "Admin/config/upload_config", // 上传配置
    // 'mapConfig' : baseUrl + "Admin/config/map_config", // 地图配置
    // 'wxPayH5Config' : baseUrl + "Admin/config/wxpay_h5_config", // 微信支付H5
    // 'wxPayAppConfig' : baseUrl + "Admin/config/wxpay_app_config", // 微信支付app
    // 'wxPayJsApiConfig' : baseUrl + "Admin/config/wxpay_jsapi_config", // 微信支付jsapi
    // 'wxPayMiNiConfig' : baseUrl + "Admin/config/wxpay_mini_config", // 微信支付小程序mini
    // 'aliPayH5Config' : baseUrl + "Admin/config/alipay_h5_config", // 支付宝支付H5
    // 'aliPayAppConfig' : baseUrl + "Admin/config/alipay_app_config", // 支付宝支付APP
    // 'aliPayPcConfig' : baseUrl + "Admin/config/alipay_pc_config", // 支付宝支付PC
    // 'aliSmsConfig' : baseUrl + "Admin/config/alisms_config", // 阿里云sms
    // 'wechatPublicConfig' : baseUrl + "Admin/config/wechat_public_config", // 公众号微信
    // 'freightKeyConfig' : baseUrl + "Admin/config/freight_config", // 物流配置
    // 'oauthConfig' : baseUrl + "Admin/config/oauth_config", // 微信第三方登录Oauth配置 pc
    // 'distributionConfig' : baseUrl + "Admin/config/distribution_config", // 分销配置
    // 'TaskTimeConfig' : baseUrl + "Admin/config/task_time_config", // 分销配置
    //
    // // 短信列表
    // 'getSmsLogList' : baseUrl + "Admin/sms_log/index",
    // 'delSmsLog' : baseUrl + "Admin/sms_log/del",
    //
    //
    // // 清空缓存
    // 'cacheFlush' : baseUrl + "Admin/auto/cache_flush",

    //会员信息
    'getMembers': baseUrl + "Sp110/members",
    'getIdentity': baseUrl + "Sp110/identity",
    'addIdentity': baseUrl + "Sp110/identity",
    'editIdentity': baseUrl + "Sp110/identity/",
    'updateIdentity': baseUrl + "Sp110/identity/",
    'delIdentity': baseUrl + "Sp110/identity/",
}


export const tools = {
    "checkUserLogin": baseUrl + "Tools/check_user_login", // 验证是否已经登录
    "login": baseUrl + "Tools/login", // 登录
    "logout": baseUrl + "Tools/logout", // 退出账号 注销
    'getUserInfo': baseUrl + "Tools/user/get_user_info", // 获取用户信息
    // 'getUserList' : baseUrl + "Admin/users/index",
    //
    //
    // 获取后台权限栏目
    'getPermissionMenus': baseUrl + "Tools/users/get_permission_menus",
    // 'getBreadNav' : baseUrl + "Admin/menus/get_bread_nav",
    //
    // // 钩子API
    // 'getHooksList' : baseUrl + "Admin/hooks/index",
    // 'addHook' : baseUrl + "Admin/hooks/add",
    // 'editHook' : baseUrl + "Admin/hooks/edit/",
    // 'delHook' : baseUrl + "Admin/hooks/del",
    //
    // 菜单API
    'getMenusList': baseUrl + "Tools/menus",
    'addMenus': baseUrl + "Tools/menus",
    'getSortMenus': baseUrl + "Tools/menus/sortmenus",
    'updateSortMenus': baseUrl + "Tools/menus/updatesortmenus",
    'editMenus': baseUrl + "Tools/menus/",
    'delMenus': baseUrl + "Tools/menus/",
    'updateMenus': baseUrl + "Tools/menus/",

    // // 角色API
    'getRolesList': baseUrl + "Tools/roles",
    'addRoles': baseUrl + "Tools/roles",
    'editRoles': baseUrl + "Tools/roles/",
    'updateRoles': baseUrl + "Tools/roles/",
    'delRoles': baseUrl + "Tools/roles/",
    //
    // // 用户API
    'getUsersList': baseUrl + "Tools/users",
    'addUsers': baseUrl + "Tools/users",
    'editPassword': baseUrl + "Tools/users/password",
    'editUsers': baseUrl + "Tools/users/",
    'delUsers': baseUrl + "Tools/users/",
    'updateUsers': baseUrl + "Tools/users/"

}


export const produce = {
    "checkUserLogin": baseUrl + "Produce/check_user_login", // 验证是否已经登录
    "login": baseUrl + "Produce/login", // 登录
    "logout": baseUrl + "Produce/logout", // 退出账号 注销
    'getUserInfo': baseUrl + "Produce/user/get_user_info", // 获取用户信息
    // 'getUserList' : baseUrl + "Admin/users/index",
    //
    //
    // 获取后台权限栏目
    'getPermissionMenus': baseUrl + "Produce/users/get_permission_menus",
    // 'getBreadNav' : baseUrl + "Admin/menus/get_bread_nav",
    //
    // // 钩子API
    // 'getHooksList' : baseUrl + "Admin/hooks/index",
    // 'addHook' : baseUrl + "Admin/hooks/add",
    // 'editHook' : baseUrl + "Admin/hooks/edit/",
    // 'delHook' : baseUrl + "Admin/hooks/del",
    //
    // 菜单API
    'getMenusList': baseUrl + "Produce/menus",
    'addMenus': baseUrl + "Produce/menus",
    'getSortMenus': baseUrl + "Produce/menus/sortmenus",
    'updateSortMenus': baseUrl + "Produce/menus/updatesortmenus",
    'editMenus': baseUrl + "Produce/menus/",
    'delMenus': baseUrl + "Produce/menus/",
    'updateMenus': baseUrl + "Produce/menus/",

    // // 角色API
    'getRolesList': baseUrl + "Produce/roles",
    'addRoles': baseUrl + "Produce/roles",
    'editRoles': baseUrl + "Produce/roles/",
    'updateRoles': baseUrl + "Produce/roles/",
    'delRoles': baseUrl + "Produce/roles/",
    //
    // // 用户API
    'getUsersList': baseUrl + "Produce/users",
    'addUsers': baseUrl + "Produce/users",
    'getRolesUser': baseUrl + "Produce/users/edit_user_role/",
    'editPassword': baseUrl + "Produce/users/password",
    'editUsers': baseUrl + "Produce/users/",
    'delUsers': baseUrl + "Produce/users/",
    'updateUsers': baseUrl + "Produce/users/",
    'updateRolesUser': baseUrl +"Produce/users/update_user_role/",

    //操作员信息
    'getOperators': baseUrl + "Produce/operators",
    //sp100库存信息
    'getStock':baseUrl+ 'Produce/stocks'

}