import{_ as u}from"./AuthenticatedLayout.af65744a.js";import{_ as h}from"./Pagination.846c1ff4.js";import{o as s,i as f,w as l,b as t,a as n,n as o,e as c,L as i,c as r,F as m,s as b,j as p,t as d}from"./app.6d525ec6.js";const k={class:"d-flex align-auto align-items-center"},y=t("div",{class:"h4 me-auto"},"\u041A\u043E\u0440\u0438\u0441\u0442\u0443\u0432\u0430\u0447\u0456",-1),g=t("i",{class:"fa-sharp fa-solid fa-plus"},null,-1),v={key:0},w={class:"table table-hover mt-3 w-100 align-middle"},C=t("thead",null,[t("tr",null,[t("th",{scope:"col",style:{width:"1%"}},"#"),t("th",{scope:"col"},"\u041A\u043E\u0440\u0438\u0441\u0442\u0443\u0432\u0430\u0447"),t("th",{scope:"col"},"\u0415\u043B\u0435\u043A\u0442\u0440\u043E\u043D\u043D\u0430 \u043F\u043E\u0448\u0442\u0430"),t("th",{scope:"col"},"\u0420\u043E\u043B\u044C"),t("th",{scope:"col",style:{width:"1%"}},"\u0414\u0456\u0457")])],-1),x={class:"btn-group btn-group-sm"},B=t("i",{class:"fa-solid fa-pen-to-square"},null,-1),$=t("i",{class:"fa-solid fa-eye"},null,-1),L=["onClick"],N=t("i",{class:"fa-solid fa-trash"},null,-1),V=[N],E={__name:"Index",props:["users","can"],setup(a){return(_,F)=>(s(),f(u,null,{default:l(()=>[t("div",k,[y,t("div",null,[n(c(i),{href:_.route("admin.users.create"),class:o(["btn btn-secondary",{disabled:!a.can.create}])},{default:l(()=>[g]),_:1},8,["href","class"])])]),a.users.data.length?(s(),r("div",v,[t("table",w,[C,t("tbody",null,[(s(!0),r(m,null,b(a.users.data,e=>(s(),r("tr",{class:"table-rov",key:e.data.id},[t("td",null,d(e.data.id),1),t("td",null,d(e.data.name||"-"),1),t("td",null,d(e.data.email||"-"),1),t("td",null,d(e.data.role_text||"-"),1),t("td",null,[t("span",x,[n(c(i),{href:e.links.edit_url,class:o(["btn btn-secondary",{disabled:!e.meta.can.update}])},{default:l(()=>[B]),_:2},1032,["href","class"]),n(c(i),{href:e.links.show_url,class:o(["btn btn-secondary",{disabled:!e.meta.can.view}])},{default:l(()=>[$]),_:2},1032,["href","class"]),t("button",{class:o(["btn btn-danger",{disabled:!e.meta.can.delete}]),onClick:j=>_.$inertia.delete(e.links.delete_url)},V,10,L)])])]))),128))])]),n(h,{model:a.users},null,8,["model"])])):p("",!0)]),_:1}))}};export{E as default};