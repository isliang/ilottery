webpackJsonp([1],{"7QVd":function(t,e){},NHnr:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a("7+uW"),c={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"app"}},[e("router-view")],1)},staticRenderFns:[]};var r=a("VU/8")({name:"App"},c,!1,function(t){a("gsu9")},null,null).exports,o=a("/ocq"),l={name:"Home",data:function(){return{checkData:{red:"",blue:""},lottery:[],title:""}},methods:{check:function(){var t=this;this.axios.get("/api/check",{params:{red:this.checkData.red,blue:this.checkData.blue}}).then(function(e){200===e.data.code&&(t.lottery=e.data.list,e.data.list.length>0?t.title="有历史中奖号(自2013年1月1号开始)":t.title="没有历史中奖号(自2013年1月1号开始)")}).catch(function(t){console.log(t)})}}},s={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"home"},[a("Layout",[a("Content",[a("Form",{ref:"checkData",attrs:{model:t.checkData,inline:""}},[a("FormItem",{attrs:{prop:"red"}},[a("Input",{attrs:{type:"text",placeholder:"红球"},model:{value:t.checkData.red,callback:function(e){t.$set(t.checkData,"red",e)},expression:"checkData.red"}})],1),t._v(" "),a("br"),t._v(" "),a("FormItem",{attrs:{prop:"blue"}},[a("Input",{attrs:{type:"text",placeholder:"蓝球"},model:{value:t.checkData.blue,callback:function(e){t.$set(t.checkData,"blue",e)},expression:"checkData.blue"}})],1),t._v(" "),a("br"),t._v(" "),a("FormItem",[a("Button",{attrs:{type:"primary"},on:{click:function(e){return t.check("checkData")}}},[t._v("查询")])],1)],1),t._v(" "),a("List",{attrs:{border:"","item-layout":"vertical"}},[t._v("\n                "+t._s(t.title)+"\n                "),t._l(t.lottery,function(e,n){return a("ListItem",{key:n},[a("li",[t._v("期号："+t._s(e.code))]),t._v(" "),a("li",[t._v("日期："+t._s(e.date))]),t._v(" "),a("li",[t._v("当期销量: "+t._s(e.sales))]),t._v(" "),a("li",[t._v("奖池: "+t._s(e.poolmoney))]),t._v(" "),a("li",[t._v("一等奖分布："+t._s(e.content))])])})],2)],1)],1)],1)},staticRenderFns:[]};var i=a("VU/8")(l,s,!1,function(t){a("cMfA")},"data-v-9e521982",null).exports;n.default.use(o.a);var u=new o.a({mode:"history",routes:[{path:"/",name:"Home",component:i}]}),d=a("b3L9"),p=a.n(d),h=(a("7QVd"),a("mtWM")),v=a.n(h),f=a("Rf8U"),m=a.n(f),_=a("ppUw"),k=a.n(_);n.default.config.productionTip=!1,n.default.use(p.a),n.default.use(m.a,v.a),n.default.use(k.a),new n.default({el:"#app",router:u,components:{App:r},template:"<App/>"})},cMfA:function(t,e){},gsu9:function(t,e){}},["NHnr"]);
//# sourceMappingURL=app.7c49ad08ed3937c74ca1.js.map