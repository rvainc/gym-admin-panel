import{o as n,c as d,b as i,a as h,w as p,t as l,e as u,k as o,F as c}from"./app.6d525ec6.js";const f={props:{title:{type:String,required:!1}},data(){return{provider:this.$headManager.createProvider()}},beforeUnmount(){this.provider.disconnect()},methods:{isUnaryTag(e){return["area","base","br","col","embed","hr","img","input","keygen","link","meta","param","source","track","wbr"].indexOf(e.type)>-1},renderTagStart(e){e.props=e.props||{},e.props.inertia=e.props["head-key"]!==void 0?e.props["head-key"]:"";const t=Object.keys(e.props).reduce((r,s)=>{const a=e.props[s];return["key","head-key"].includes(s)?r:a===""?r+` ${s}`:r+` ${s}="${a}"`},"");return`<${e.type}${t}>`},renderTagChildren(e){return typeof e.children=="string"?e.children:e.children.reduce((t,r)=>t+this.renderTag(r),"")},renderTag(e){if(e.type.toString()==="Symbol(Text)")return e.children;if(e.type.toString()==="Symbol()")return"";if(e.type.toString()==="Symbol(Comment)")return"";let t=this.renderTagStart(e);return e.children&&(t+=this.renderTagChildren(e)),this.isUnaryTag(e)||(t+=`</${e.type}>`),t},addTitleElement(e){return this.title&&!e.find(t=>t.startsWith("<title"))&&e.push(`<title inertia>${this.title}</title>`),e},renderNodes(e){return this.addTitleElement(e.flatMap(t=>t.type.toString()==="Symbol(Fragment)"?t.children:t).map(t=>this.renderTag(t)).filter(t=>t))}},render(){this.provider.update(this.renderNodes(this.$slots.default?this.$slots.default():[]))}},g={class:"d-flex justify-content-center align-items-center",style:{"min-height":"100vh"}},m={class:"shadow shadow-sm p-3 p-lg-4 bg-white w-100",style:{"max-width":"28rem"}},y={class:"h5 mb-4"},b={__name:"GuestLayout",props:{title:{type:String,default:"Universal Sports Academy"}},setup(e){return(t,r)=>(n(),d(c,null,[i("header",null,[h(u(f),null,{default:p(()=>[i("title",null,l(e.title),1)]),_:1})]),i("main",null,[i("div",g,[i("div",m,[i("div",y,l(e.title),1),o(t.$slots,"default")])])])],64))}};export{b as _};