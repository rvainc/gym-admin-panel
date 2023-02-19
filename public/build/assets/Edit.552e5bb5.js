import{r as f,u as v,o as h,c as g,a as n,w,b as s,d as m,v as i,e as t,n as d,f as p,F as N}from"./app.6d525ec6.js";import{_ as x}from"./AuthenticatedLayout.af65744a.js";import{_ as u}from"./InputError.2323ae00.js";import{_ as y}from"./BarCodeReaderModal.ed88a8d2.js";const I=s("div",{class:"h5 mb-4"},"\u0420\u0435\u0434\u0430\u0433\u0443\u0432\u0430\u0442\u0438 \u043A\u043B\u0456\u0454\u043D\u0442\u0430",-1),V={class:"row"},$={class:"col-12 col-md-6"},C={class:"mb-3"},B=s("label",{for:"firstNameInput",class:"form-label"},"\u0406\u043C'\u044F",-1),U={class:"col-12 col-md-6"},k={class:"mb-3"},D=s("label",{for:"lastNameInput",class:"form-label"},"\u041F\u0440\u0456\u0437\u0432\u0438\u0449\u0435",-1),F={class:"row"},E={class:"col-12 col-md-6"},M={class:"mb-3"},z=s("label",{for:"phoneNumberInput",class:"form-label"},"\u041D\u043E\u043C\u0435\u0440 \u0442\u0435\u043B\u0435\u0444\u043E\u043D\u0430",-1),R={class:"col-12 col-md-6"},S={class:"mb-3"},T=s("label",{class:"form-label"},"\u041D\u043E\u043C\u0435\u0440 \u043A\u0430\u0440\u0442\u0438",-1),j={class:"input-group"},q=s("i",{class:"fa-solid fa-barcode"},null,-1),A=[q],G=["disabled"],O={__name:"Edit",props:["customer"],setup(_){const r=_,l=f(!1);function b(c){l.value=!1,e.card_number=c.text}const e=v({first_name:r.customer.data.first_name,last_name:r.customer.data.last_name,phone_number:r.customer.data.phone_number,card_number:r.customer.data.card_number});return(c,o)=>(h(),g(N,null,[n(x,null,{default:w(()=>[I,s("form",{onSubmit:o[5]||(o[5]=p(a=>t(e).patch(c.route("admin.customers.update",_.customer.data.id)),["prevent"]))},[s("div",V,[s("div",$,[s("div",C,[B,m(s("input",{id:"firstNameInput","onUpdate:modelValue":o[0]||(o[0]=a=>t(e).first_name=a),type:"text",class:d(["form-control",{"is-invalid":t(e).errors.first_name}])},null,2),[[i,t(e).first_name]]),n(u,{message:t(e).errors.first_name},null,8,["message"])])]),s("div",U,[s("div",k,[D,m(s("input",{"onUpdate:modelValue":o[1]||(o[1]=a=>t(e).last_name=a),type:"text",id:"lastNameInput",class:d(["form-control",{"is-invalid":t(e).errors.last_name}])},null,2),[[i,t(e).last_name]]),n(u,{message:t(e).errors.last_name},null,8,["message"])])])]),s("div",F,[s("div",E,[s("div",M,[z,m(s("input",{id:"phoneNumberInput","onUpdate:modelValue":o[2]||(o[2]=a=>t(e).phone_number=a),type:"tel",class:d(["form-control",{"is-invalid":t(e).errors.phone_number}])},null,2),[[i,t(e).phone_number]]),n(u,{message:t(e).errors.phone_number},null,8,["message"])])]),s("div",R,[s("div",S,[T,s("div",j,[m(s("input",{id:"cardNumberInput","onUpdate:modelValue":o[3]||(o[3]=a=>t(e).card_number=a),type:"text",class:d(["form-control",{"is-invalid":t(e).errors.card_number}])},null,2),[[i,t(e).card_number]]),s("button",{class:"btn btn-outline-secondary",onClick:o[4]||(o[4]=p(a=>l.value=!0,["prevent"]))},A)]),n(u,{message:t(e).errors.card_number},null,8,["message"])])])]),s("button",{type:"submit",class:"btn btn-primary",disabled:t(e).processing},"\u0417\u0431\u0435\u0440\u0435\u0433\u0442\u0438",8,G)],32)]),_:1}),n(y,{show:l.value,onClosed:o[6]||(o[6]=a=>l.value=!1),onDecode:b},null,8,["show"])],64))}};export{O as default};
