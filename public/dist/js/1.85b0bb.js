(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{11:function(t,e,r){"use strict";var s={name:"Breadcrumbs"},a=r(1),n=Object(a.a)(s,(function(){var t=this.$createElement;this._self._c;return this._m(0)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("nav",{attrs:{"aria-label":"breadcrumb"}},[e("ol",{staticClass:"breadcrumb"},[e("li",{staticClass:"breadcrumb-item"},[e("a",{attrs:{href:"#"}},[this._v("Apps")])]),this._v(" "),e("li",{staticClass:"breadcrumb-item active",attrs:{"aria-current":"page"}},[this._v("Dashboard")])])])}],!1,null,"5cad8d16",null);e.a=n.exports},15:function(t,e,r){"use strict";r.r(e);var s=r(0),a=r.n(s),n=r(11),o=r(3),c=r(4),i=r.n(c);function l(t,e,r,s,a,n,o){try{var c=t[n](o),i=c.value}catch(t){return void r(t)}c.done?e(i):Promise.resolve(i).then(s,a)}function u(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,s)}return r}function d(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var m={name:"customers",data:function(){return{delete_modal:{show:!1,report_id:0},fields:[{key:"id",label:"#",sortable:!1},{key:"name",label:"Customer Name",sortable:!0},"actions"]}},components:{Breadcrumbs:n.a},beforeCreate:function(){this.$store.dispatch("app/fetchCustomers")},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?u(Object(r),!0).forEach((function(e){d(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):u(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(o.c)({customers:"app/customers"})),methods:{deleteCustomer:function(t){this.delete_modal.customer_id=t,this.delete_modal.show=!0},close:function(){this.delete_modal.show=!1},removeCustomer:function(){var t,e=this;return(t=a.a.mark((function t(){return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,i.a.delete("/api/customer/".concat(e.delete_modal.report_id));case 2:e.$store.dispatch("app/fetchCustomers"),e.close();case 4:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(s,a){var n=t.apply(e,r);function o(t){l(n,s,a,o,c,"next",t)}function c(t){l(n,s,a,o,c,"throw",t)}o(void 0)}))})()}}},p=r(1),v=Object(p.a)(m,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"page-content"},[r("div",{staticClass:"page-info"},[r("breadcrumbs"),t._v(" "),r("div",{staticClass:"page-options"},[r("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"customer.create"}}},[t._v("Add Customer")])],1)],1),t._v(" "),r("div",{staticClass:"main-wrapper"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-xl"},[r("div",{staticClass:"card"},[t.customers.length?r("div",{staticClass:"card-body table-responsive"},[r("h5",{staticClass:"card-title"},[t._v("Reports")]),t._v(" "),r("b-table",{attrs:{items:t.customers,fields:t.fields},scopedSlots:t._u([{key:"head(actions)",fn:function(e){return[r("div",{staticClass:"text-center"},[r("span",[t._v(t._s(e.label))])])]}},{key:"cell(actions)",fn:function(e){return[r("div",{staticClass:"text-center"},[r("router-link",{staticClass:"text-muted",attrs:{to:{name:"report.view",params:{id:e.item.id}}}},[r("font-awesome-icon",{attrs:{icon:["fas","eye"]}})],1),t._v(" "),r("a",{staticClass:"text-muted",attrs:{href:"#"},on:{click:function(r){return t.deleteCustomer(e.item.id)}}},[r("font-awesome-icon",{attrs:{icon:["fas","trash"]}})],1)],1)]}}],null,!1,3418415748)})],1):r("div",{staticClass:"card-body text-center"},[r("h5",{staticClass:"card-title"},[t._v("No Customer")]),t._v(" "),r("p",{staticClass:"card-text"},[t._v("There are no customers to show.")]),t._v(" "),r("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"report.create"}}},[t._v("\n              Add Customer\n            ")])],1)])])])]),t._v(" "),r("b-modal",{attrs:{centered:""},scopedSlots:t._u([{key:"modal-header",fn:function(e){var s=e.close;return[r("h5",[t._v("Are you sure?")]),t._v(" "),r("button",{staticClass:"close",attrs:{type:"button"},on:{click:s}},[r("i",{staticClass:"material-icons"},[t._v("close")])])]}},{key:"modal-footer",fn:function(){return[r("b-button",{attrs:{variant:"secondary"},on:{click:function(e){return t.close()}}},[t._v("\n        Cancel\n      ")]),t._v(" "),r("b-button",{attrs:{variant:"danger"},on:{click:t.removeCustomer}},[t._v("\n        Delete\n      ")])]},proxy:!0}]),model:{value:t.delete_modal.show,callback:function(e){t.$set(t.delete_modal,"show",e)},expression:"delete_modal.show"}},[t._v(" "),r("p",[t._v("Deleting a customer will delete all the reports associated with that customer. Are you sure you want to delete this customer?")])])],1)}),[],!1,null,"0b23deb8",null);e.default=v.exports}}]);