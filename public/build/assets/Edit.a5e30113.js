import{_ as t}from"./AuthenticatedLayout.af65744a.js";import r from"./UserForm.5ea97a1e.js";import{o as s,i as a,w as i,a as m,b as l}from"./app.6d525ec6.js";import"./InputError.2323ae00.js";import"./vue-select.es.db4b72ca.js";const u=l("div",{class:"h5 mb-4"},"\u0420\u0435\u0434\u0430\u0433\u0443\u0432\u0430\u0442\u0438 \u043A\u043E\u0440\u0438\u0441\u0442\u0443\u0432\u0430\u0447\u0430",-1),h={__name:"Edit",props:["roleOptions","user"],setup(e){return(o,d)=>(s(),a(t,null,{default:i(()=>[u,m(r,{url:o.route("admin.users.update",{user:e.user.data.id}),model:e.user,"is-edit-mode":!0,method:"PUT","role-options":e.roleOptions},null,8,["url","model","role-options"])]),_:1}))}};export{h as default};