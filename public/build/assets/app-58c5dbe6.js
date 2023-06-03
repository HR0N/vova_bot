var p=(i,t,s)=>{if(!t.has(i))throw TypeError("Cannot "+s)};var h=(i,t,s)=>{if(t.has(i))throw TypeError("Cannot add the same private member more than once");t instanceof WeakSet?t.add(i):t.set(i,s)};var a=(i,t,s)=>(p(i,t,"access private method"),s);var o,n;class c{constructor(t){h(this,o);this.el=$(t),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}})}find(t){return this.el.find(t)}values(t){let s={},r=$(t).find("input"),e=$(t).find("textarea"),m=$(t).find("select");return a(this,o,n).call(this,s,r),a(this,o,n).call(this,s,e),a(this,o,n).call(this,s,m),s}get(t,s=()=>{},r=()=>{}){$.get(t).done(e=>s(e)).fail(e=>r(e))}post(t,s=()=>{},r=()=>{}){$.post(t).done(e=>s(e)).fail(e=>r(e))}}o=new WeakSet,n=function(t,s){s&&s.map((r,e)=>{$(e).attr("type")!=="checkbox"&&$(e).attr("type")!=="radio"?t[$(e).attr("name")]=$(e).val():t[$(e).attr("name")]=$(e).prop("checked")})};$(document).ready(()=>{new l("main")});class _ extends c{constructor(t){super(t),this.groups_data=null,this.groups=this.find("#groups"),this.category=this.find("#category"),this.apartment=this.find(".apartment"),this.apartment__city=this.find('input[name="apartment__city"]'),this.apartment__district=this.find('input[name="apartment__district"]'),this.apartment__price_from=this.find('input[name="price1"]'),this.apartment__price_to=this.find('input[name="price2"]'),this.apartment__rooms_all=this.find('input[name="all"]'),this.apartment__rooms_one=this.find('input[name="r1"]'),this.apartment__rooms_two=this.find('input[name="r2"]'),this.apartment__rooms_three=this.find('input[name="r3"]'),this.apartment__rooms_four=this.find('input[name="r4"]'),this.apartment__rooms_five=this.find('input[name="r5"]'),this.apartment__form=this.apartment.find("form"),this.apartment__submit=this.apartment.find(".submit"),this.rooms=this.find(".rooms"),this.rooms__city=this.find('input[name="rooms__city"]'),this.rooms__district=this.find('input[name="rooms__district"]'),this.rooms__price_from=this.find('input[name="price1"]'),this.rooms__price_to=this.find('input[name="price2"]'),this.rooms__form=this.rooms.find("form"),this.rooms__submit=this.rooms.find(".submit"),this.request_urls={district:"&search[district_id]=",price1:"&search[filter_float_price:from]=",price2:"&search[filter_float_price:to]=",rooms1:"&search[filter_enum_number_of_rooms_string][0]=odnokomnatnye",rooms2:"&search[filter_enum_number_of_rooms_string][1]=dvuhkomnatnye",rooms3:"&search[filter_enum_number_of_rooms_string][2]=trehkomnatnye",rooms4:"&search[filter_enum_number_of_rooms_string][3]=chetyrehkomnatnye",rooms5:"&search[filter_enum_number_of_rooms_string][4]=pyatikomnatnye"}}}class l extends _{constructor(t){super(t),this.process=new u(t),this.server=new d(t),this.onload(),this.events()}onload(){this.process.toggle_category(),this.server.get_groups_data(this.process.render_groups.bind(this))}events(){this.groups.on("change",this.process.on_group_change.bind(this)),this.category.on("change",()=>{this.process.toggle_category()}),this.apartment__rooms_all.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__rooms_one.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__rooms_two.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__rooms_three.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__rooms_four.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__rooms_five.on("change",this.process.toggle_rooms_checkboxes.bind(this)),this.apartment__submit.on("click",this.process.apartment_submit.bind(this)),this.rooms__submit.on("click",this.process.rooms_submit.bind(this))}}class u extends _{constructor(t){super(t),this.testing()}toggle_category(){const t=this.category.val();this.apartment.removeClass("flex"),this.rooms.removeClass("flex"),t==="apartment"&&this.apartment.addClass("flex"),t==="rooms"&&this.rooms.addClass("flex")}toggle_rooms_checkboxes(t){$(t.target).attr("name")==="all"&&$(t.target).prop("checked")?(this.apartment__rooms_one.prop("checked",!1),this.apartment__rooms_two.prop("checked",!1),this.apartment__rooms_three.prop("checked",!1),this.apartment__rooms_four.prop("checked",!1),this.apartment__rooms_five.prop("checked",!1)):$(t.target).attr("name")!=="all"&&$(t.target).prop("checked")&&this.apartment__rooms_all.prop("checked",!1)}render_groups(t){t.map((s,r)=>{this.groups.append(`<option value='${s.id}' data-group-id='${s.group_id}'>${s.group_title}</option>`)}),this.groups_data=t}on_group_change(){this.groups.val()===null?(this.apartment.addClass("filters_hide"),this.rooms.addClass("filters_hide")):(this.apartment.removeClass("filters_hide"),this.rooms.removeClass("filters_hide"))}apartment_submit(){const t=this.values(this.apartment__form);let s={rent_type:this.category.val(),city:t.apartment__city,district:`${this.request_urls.district}${t.apartment__district}`,price:`${t.price1&&this.request_urls.price1}${t.price1}${t.price2&&this.request_urls.price2}${t.price2}`,rooms:`${t.r1?this.request_urls.rooms1:""}${t.r2?this.request_urls.rooms2:""}${t.r3?this.request_urls.rooms3:""}${t.r4?this.request_urls.rooms4:""}${t.r5?this.request_urls.rooms5:""}`};s.request_url=s.district+s.price+s.rooms;const r=`${location.origin}/TgGroupsUpdate/${this.groups.val()}`;this.server.update_group_data(r,s)}rooms_submit(){const t=this.values(this.rooms__form);let s={rent_type:this.category.val(),city:t.rooms__city,district:`${this.request_urls.district}${t.rooms__district}`,price:`${t.price1&&this.request_urls.price1}${t.price1}${t.price2&&this.request_urls.price2}${t.price2}`,rooms:""};s.request_url=s.district+s.price;const r=`${location.origin}/TgGroupsUpdate/${this.groups.val()}`;this.server.update_group_data(r,s)}testing(){}}class d extends _{constructor(t){super(t)}get_groups_data(t=()=>{},s=()=>{}){return this.get(`${location.origin}/TgGroupsIndex`,t,s)}update_group_data(t,s){$.post(t,s).fail(r=>{console.log(r)}).done(r=>{console.log(r)})}}
