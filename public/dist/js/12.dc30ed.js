(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{33:function(t,e,r){"use strict";r.r(e);var a=r(0),s=r.n(a),n=r(2),o=r.n(n);function i(t,e,r,a,s,n,o){try{var i=t[n](o),l=i.value}catch(t){return void r(t)}i.done?e(l):Promise.resolve(l).then(a,s)}var l={middleware:"guest",metaInfo:function(){return{title:this.$t("verify_email")}},data:function(){return{status:"",form:new o.a({email:""})}},created:function(){this.$route.query.email&&(this.form.email=this.$route.query.email)},methods:{send:function(){var t,e=this;return(t=s.a.mark((function t(){var r,a;return s.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.form.post("/api/email/resend");case 2:r=t.sent,a=r.data,e.status=a.status,e.form.reset();case 6:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(a,s){var n=t.apply(e,r);function o(t){i(n,a,s,o,l,"next",t)}function l(t){i(n,a,s,o,l,"throw",t)}o(void 0)}))})()}}},m=r(1),u=Object(m.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"row"},[r("div",{staticClass:"col-lg-8 m-auto"},[r("card",{attrs:{title:t.$t("verify_email")}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.send(e)},keydown:function(e){return t.form.onKeydown(e)}}},[r("alert-success",{attrs:{form:t.form,message:t.status}}),t._v(" "),r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("email")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",class:{"is-invalid":t.form.errors.has("email")},attrs:{type:"email",name:"email"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}}),t._v(" "),r("has-error",{attrs:{form:t.form,field:"email"}})],1)]),t._v(" "),r("div",{staticClass:"form-group row"},[r("div",{staticClass:"col-md-9 ml-md-auto"},[r("v-button",{attrs:{loading:t.form.busy}},[t._v("\n              "+t._s(t.$t("send_verification_link"))+"\n            ")])],1)])],1)])],1)])}),[],!1,null,null,null);e.default=u.exports}}]);