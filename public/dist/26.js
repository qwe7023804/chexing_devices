(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[26],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/babel-loader/lib??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "index",
  data: function data() {
    return {
      permissions_list: []
    };
  },
  methods: {
    get_permission_list: function get_permission_list() {
      var _this = this;

      this.$get(this.$sp110.getPermissionList).then(function (res) {
        _this.permissions_list = res.data;
      });
    },
    addmenus: function addmenus() {
      this.$refs.childMenu.childFun(this.menus_list);
    },
    directoryEdit: function directoryEdit(id) {
      this.$refs.childEditMenu.childFun(id);
    },
    directoryDelete: function directoryDelete(id) {
      var _this = this;

      this.$delete(this.$sp110.delMenus + id).then(function (res) {
        if (res.code === 200) {
          _this.$message({
            message: '删除成功！',
            type: 'success'
          });

          _this.reload();
        } else {
          _this.$message.error({
            message: res.msg
          });
        }
      });
    },
    directorysort: function directorysort(title) {
      this.$refs.chilSortMenu.childFun(title);
    },
    refresh: function refresh() {
      this.reload();
    }
  },
  created: function created() {
    this.get_permission_list();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "el-row",
        [
          _c(
            "el-col",
            { attrs: { span: 24 } },
            [
              _c(
                "el-button",
                {
                  attrs: { type: "primary", icon: "el-icon-plus" },
                  on: { click: _vm.addmenus }
                },
                [_vm._v("新增菜单")]
              ),
              _vm._v(" "),
              _c(
                "el-button",
                {
                  attrs: { plain: "", type: "warning", icon: "el-icon-sort" },
                  on: {
                    click: function($event) {
                      return _vm.directorysort({
                        title: "一级目录排序",
                        order: "1"
                      })
                    }
                  }
                },
                [_vm._v("\n                    目录排序\n                ")]
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-table",
        {
          staticStyle: { width: "100%" },
          attrs: {
            data: _vm.permissions_list,
            "row-key": "id",
            lazy: "",
            "tree-props": { children: "children", hasChildren: "hasChildren" }
          }
        },
        [
          _c("el-table-column", { attrs: { prop: "title", label: "名称" } }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "controller_action", label: "权限标识" }
          }),
          _vm._v(" "),
          _c("el-table-column", { attrs: { prop: "order", label: "排序" } }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "操作" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    _c(
                      "el-button",
                      {
                        attrs: { type: "primary", size: "mini" },
                        on: {
                          click: function($event) {
                            return _vm.directoryEdit(scope.row.id)
                          }
                        }
                      },
                      [_vm._v("编辑\n                    ")]
                    ),
                    _vm._v(" "),
                    _c(
                      "el-popconfirm",
                      {
                        attrs: {
                          confirmButtonText: "删除",
                          cancelButtonText: "取消",
                          confirmButtonType: "danger",
                          icon: "el-icon-info",
                          placement: "left-end",
                          iconColor: "red",
                          title: "是否删除此菜单？"
                        },
                        on: {
                          onConfirm: function($event) {
                            return _vm.directoryDelete(scope.row.id)
                          }
                        }
                      },
                      [
                        _c(
                          "el-button",
                          {
                            staticStyle: { "margin-left": "10px" },
                            attrs: {
                              slot: "reference",
                              type: "danger",
                              size: "small"
                            },
                            slot: "reference"
                          },
                          [_vm._v("删除")]
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    scope.row.uri === "/"
                      ? [
                          _c(
                            "el-button",
                            {
                              attrs: {
                                plain: "",
                                type: "warning",
                                size: "mini"
                              },
                              on: {
                                click: function($event) {
                                  return _vm.directorysort({
                                    title: "二级目录排序",
                                    parent_id: scope.row.id
                                  })
                                }
                              }
                            },
                            [
                              _vm._v("目录排序\n                            "),
                              _c("i", { staticClass: "el-icon-sort" })
                            ]
                          )
                        ]
                      : _vm._e()
                  ]
                }
              }
            ])
          })
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/sp110/permissions/index.vue":
/*!********************************************************!*\
  !*** ./resources/js/views/sp110/permissions/index.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=94f8b048&scoped=true& */ "./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "94f8b048",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/sp110/permissions/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_babel_loader_lib_index_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/babel-loader/lib??ref--11-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/sp110/permissions/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_babel_loader_lib_index_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=94f8b048&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/sp110/permissions/index.vue?vue&type=template&id=94f8b048&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_94f8b048_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);