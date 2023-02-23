import{_ as u}from"./AuthenticatedLayout.318d19df.js";import{o as e,i as m,w as o,b as t,t as a,c as n,a as l,e as i,L as r}from"./app.41d51c05.js";import{T as _}from"./TransactionsTable.88e7f0b2.js";import{_ as h}from"./Pagination.dad70bd6.js";import"./helpers.f458d5ee.js";import"./_plugin-vue_export-helper.cdc0426e.js";const f={class:"d-flex align-auto align-items-center"},v={class:"h4 me-auto"},b={class:"row w-100 mt-3"},g={class:"col-12 col-md-6"},k={class:"w-100"},x=t("tr",null,[t("th",{style:{width:"30%"}}),t("th")],-1),y=t("td",null,[t("div",{class:"h6"},"\u0406\u043C'\u044F:")],-1),w=t("td",null,[t("div",{class:"h6"},"\u041F\u0440\u0456\u0437\u0432\u0438\u0449\u0435:")],-1),B=t("td",null,[t("div",{class:"h6"},"\u041D\u043E\u043C\u0435\u0440 \u0442\u0435\u043B\u0435\u0444\u043E\u043D\u0430:")],-1),$=t("td",null,[t("div",{class:"h6"},"\u041D\u043E\u043C\u0435\u0440 \u043A\u0430\u0440\u0442\u043A\u0438:")],-1),C={class:"text-truncate"},T=t("td",null,[t("div",{class:"h6"},"\u0421\u0442\u0430\u0442\u0443\u0441:")],-1),L={key:0,class:"badge text-bg-primary"},N={key:1,class:"badge text-bg-secondary"},V={class:"col-12 col-md-6 mt-2 mt-sm-0 text-md-end text-start"},q={class:"btn-group",role:"group"},D=t("i",{class:"fa-solid fa-pen-to-square"},null,-1),E=t("i",{class:"fa-solid fa-trash"},null,-1),S=[E],j={class:"p-md-2 mt-4"},z={class:"d-flex align-auto align-items-center"},A=t("div",{class:"h5 me-auto"},"\u0406\u0441\u0442\u043E\u0440\u0456\u044F \u0442\u0440\u0430\u043D\u0437\u0430\u043A\u0446\u0456\u0439 \u0446\u044C\u043E\u0433\u043E \u043A\u043B\u0456\u0454\u043D\u0442\u0443",-1),F={class:"me-1 ms-1 ms-md-0"},G=t("i",{class:"fa-solid fa-credit-card"},null,-1),H={key:0,class:"mt-3"},I={key:1,class:"text-center h6 p-3"},U={__name:"Customer",props:["customer","transactions"],setup(s){return(c,d)=>(e(),m(u,{title:s.customer.data.full_name},{default:o(()=>[t("div",f,[t("div",v,a(s.customer.data.full_name),1)]),t("div",b,[t("div",g,[t("table",k,[x,t("tr",null,[y,t("td",null,a(s.customer.data.first_name||"-"),1)]),t("tr",null,[w,t("td",null,a(s.customer.data.last_name||"-"),1)]),t("tr",null,[B,t("td",null,a(s.customer.data.phone_number||"-"),1)]),t("tr",null,[$,t("td",null,[t("div",C,a(s.customer.data.card_number||"-"),1)])]),t("tr",null,[T,t("td",null,[s.customer.data.active_transactions_exists?(e(),n("span",L," \u041F\u0440\u043E\u043F\u043B\u0430\u0447\u0435\u043D\u043E ")):(e(),n("span",N,"\u041D\u0435 \u043F\u0440\u043E\u043F\u043B\u0430\u0447\u0435\u043D\u043E"))])])])]),t("div",V,[t("div",q,[l(i(r),{href:s.customer.links.edit_url,class:"btn btn-secondary"},{default:o(()=>[D]),_:1},8,["href"]),t("button",{onClick:d[0]||(d[0]=J=>c.$inertia.delete(s.customer.links.delete_url)),class:"btn btn-danger"},S)])])]),t("div",j,[t("div",z,[A,t("div",F,[l(i(r),{href:c.route("admin.transactions.create",{customer:s.customer.data.id}),class:"btn btn-secondary"},{default:o(()=>[G]),_:1},8,["href"])])]),s.transactions.data.length?(e(),n("div",H,[l(_,{transactions:s.transactions},null,8,["transactions"]),l(h,{model:s.transactions},null,8,["model"])])):(e(),n("div",I," \u0416\u043E\u0434\u043D\u043E\u0433\u043E \u0437\u0430\u043F\u0438\u0441\u0443 \u0432 \u0446\u044C\u043E\u0433\u043E \u043A\u043B\u0456\u0454\u043D\u0442\u0430 \u043D\u0435 \u0437\u043D\u0430\u0439\u0434\u0435\u043D\u043E. "))])]),_:1},8,["title"]))}};export{U as default};
