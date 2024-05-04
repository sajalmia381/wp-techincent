(self.webpackChunklieblings=self.webpackChunklieblings||[]).push([[973],{9973:(e,t,n)=>{"use strict";n.r(t),n.d(t,{ProductModule:()=>G});var o=n(98),i=n(8348),a=n(8081),r=n(8707),s=n(7395),d=n(7429);const c=new i.OlP("CdkAccordion");let l=0,p=(()=>{class e{constructor(e,t,n){this.accordion=e,this._changeDetectorRef=t,this._expansionDispatcher=n,this._openCloseAllSubscription=s.w.EMPTY,this.closed=new i.vpe,this.opened=new i.vpe,this.destroyed=new i.vpe,this.expandedChange=new i.vpe,this.id="cdk-accordion-child-"+l++,this._expanded=!1,this._disabled=!1,this._removeUniqueSelectionListener=()=>{},this._removeUniqueSelectionListener=n.listen((e,t)=>{this.accordion&&!this.accordion.multi&&this.accordion.id===t&&this.id!==e&&(this.expanded=!1)}),this.accordion&&(this._openCloseAllSubscription=this._subscribeToOpenCloseAllActions())}get expanded(){return this._expanded}set expanded(e){e=(0,a.Ig)(e),this._expanded!==e&&(this._expanded=e,this.expandedChange.emit(e),e?(this.opened.emit(),this._expansionDispatcher.notify(this.id,this.accordion?this.accordion.id:this.id)):this.closed.emit(),this._changeDetectorRef.markForCheck())}get disabled(){return this._disabled}set disabled(e){this._disabled=(0,a.Ig)(e)}ngOnDestroy(){this.opened.complete(),this.closed.complete(),this.destroyed.emit(),this.destroyed.complete(),this._removeUniqueSelectionListener(),this._openCloseAllSubscription.unsubscribe()}toggle(){this.disabled||(this.expanded=!this.expanded)}close(){this.disabled||(this.expanded=!1)}open(){this.disabled||(this.expanded=!0)}_subscribeToOpenCloseAllActions(){return this.accordion._openCloseAllActions.subscribe(e=>{this.disabled||(this.expanded=e)})}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(c,12),i.Y36(i.sBO),i.Y36(d.A8))},e.\u0275dir=i.lG2({type:e,selectors:[["cdk-accordion-item"],["","cdkAccordionItem",""]],inputs:{expanded:"expanded",disabled:"disabled"},outputs:{closed:"closed",opened:"opened",destroyed:"destroyed",expandedChange:"expandedChange"},exportAs:["cdkAccordionItem"],features:[i._Bn([{provide:c,useValue:void 0}])]}),e})(),g=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({}),e})();var u=n(785),m=n(9412),h=(n(6645),n(6161)),Z=n(7682),f=n(8780),_=n(8359),x=(n(2819),n(3636)),b=(n(3487),n(5371),n(739));const A=["body"];function T(e,t){}const q=[[["mat-expansion-panel-header"]],"*",[["mat-action-row"]]],v=["mat-expansion-panel-header","*","mat-action-row"],y=new i.OlP("MAT_ACCORDION"),w="225ms cubic-bezier(0.4,0.0,0.2,1)",U={indicatorRotate:(0,b.X$)("indicatorRotate",[(0,b.SB)("collapsed, void",(0,b.oB)({transform:"rotate(0deg)"})),(0,b.SB)("expanded",(0,b.oB)({transform:"rotate(180deg)"})),(0,b.eR)("expanded <=> collapsed, void => collapsed",(0,b.jt)(w))]),bodyExpansion:(0,b.X$)("bodyExpansion",[(0,b.SB)("collapsed, void",(0,b.oB)({height:"0px",visibility:"hidden"})),(0,b.SB)("expanded",(0,b.oB)({height:"*",visibility:"visible"})),(0,b.eR)("expanded <=> collapsed, void => collapsed",(0,b.jt)(w))])};let k=(()=>{class e{constructor(e){this._template=e}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(i.Rgc))},e.\u0275dir=i.lG2({type:e,selectors:[["ng-template","matExpansionPanelContent",""]]}),e})(),C=0;const O=new i.OlP("MAT_EXPANSION_PANEL_DEFAULT_OPTIONS");let P=(()=>{class e extends p{constructor(e,t,n,o,a,s,d){super(e,t,n),this._viewContainerRef=o,this._animationMode=s,this._hideToggle=!1,this.afterExpand=new i.vpe,this.afterCollapse=new i.vpe,this._inputChanges=new r.xQ,this._headerId="mat-expansion-panel-header-"+C++,this._bodyAnimationDone=new r.xQ,this.accordion=e,this._document=a,this._bodyAnimationDone.pipe((0,h.x)((e,t)=>e.fromState===t.fromState&&e.toState===t.toState)).subscribe(e=>{"void"!==e.fromState&&("expanded"===e.toState?this.afterExpand.emit():"collapsed"===e.toState&&this.afterCollapse.emit())}),d&&(this.hideToggle=d.hideToggle)}get hideToggle(){return this._hideToggle||this.accordion&&this.accordion.hideToggle}set hideToggle(e){this._hideToggle=(0,a.Ig)(e)}get togglePosition(){return this._togglePosition||this.accordion&&this.accordion.togglePosition}set togglePosition(e){this._togglePosition=e}_hasSpacing(){return!!this.accordion&&this.expanded&&"default"===this.accordion.displayMode}_getExpandedState(){return this.expanded?"expanded":"collapsed"}toggle(){this.expanded=!this.expanded}close(){this.expanded=!1}open(){this.expanded=!0}ngAfterContentInit(){this._lazyContent&&this.opened.pipe((0,Z.O)(null),(0,f.h)(()=>this.expanded&&!this._portal),(0,_.q)(1)).subscribe(()=>{this._portal=new u.UE(this._lazyContent._template,this._viewContainerRef)})}ngOnChanges(e){this._inputChanges.next(e)}ngOnDestroy(){super.ngOnDestroy(),this._bodyAnimationDone.complete(),this._inputChanges.complete()}_containsFocus(){if(this._body){const e=this._document.activeElement,t=this._body.nativeElement;return e===t||t.contains(e)}return!1}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(y,12),i.Y36(i.sBO),i.Y36(d.A8),i.Y36(i.s_b),i.Y36(o.K0),i.Y36(x.Qb,8),i.Y36(O,8))},e.\u0275cmp=i.Xpm({type:e,selectors:[["mat-expansion-panel"]],contentQueries:function(e,t,n){if(1&e&&i.Suo(n,k,5),2&e){let e;i.iGM(e=i.CRH())&&(t._lazyContent=e.first)}},viewQuery:function(e,t){if(1&e&&i.Gf(A,5),2&e){let e;i.iGM(e=i.CRH())&&(t._body=e.first)}},hostAttrs:[1,"mat-expansion-panel"],hostVars:6,hostBindings:function(e,t){2&e&&i.ekj("mat-expanded",t.expanded)("_mat-animation-noopable","NoopAnimations"===t._animationMode)("mat-expansion-panel-spacing",t._hasSpacing())},inputs:{disabled:"disabled",expanded:"expanded",hideToggle:"hideToggle",togglePosition:"togglePosition"},outputs:{opened:"opened",closed:"closed",expandedChange:"expandedChange",afterExpand:"afterExpand",afterCollapse:"afterCollapse"},exportAs:["matExpansionPanel"],features:[i._Bn([{provide:y,useValue:void 0}]),i.qOj,i.TTD],ngContentSelectors:v,decls:7,vars:4,consts:[["role","region",1,"mat-expansion-panel-content",3,"id"],["body",""],[1,"mat-expansion-panel-body"],[3,"cdkPortalOutlet"]],template:function(e,t){1&e&&(i.F$t(q),i.Hsn(0),i.TgZ(1,"div",0,1),i.NdJ("@bodyExpansion.done",function(e){return t._bodyAnimationDone.next(e)}),i.TgZ(3,"div",2),i.Hsn(4,1),i.YNc(5,T,0,0,"ng-template",3),i.qZA(),i.Hsn(6,2),i.qZA()),2&e&&(i.xp6(1),i.Q6J("@bodyExpansion",t._getExpandedState())("id",t.id),i.uIk("aria-labelledby",t._headerId),i.xp6(4),i.Q6J("cdkPortalOutlet",t._portal))},directives:[u.Pl],styles:[".mat-expansion-panel{box-sizing:content-box;display:block;margin:0;border-radius:4px;overflow:hidden;transition:margin 225ms cubic-bezier(0.4, 0, 0.2, 1),box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);position:relative}.mat-accordion .mat-expansion-panel:not(.mat-expanded),.mat-accordion .mat-expansion-panel:not(.mat-expansion-panel-spacing){border-radius:0}.mat-accordion .mat-expansion-panel:first-of-type{border-top-right-radius:4px;border-top-left-radius:4px}.mat-accordion .mat-expansion-panel:last-of-type{border-bottom-right-radius:4px;border-bottom-left-radius:4px}.cdk-high-contrast-active .mat-expansion-panel{outline:solid 1px}.mat-expansion-panel.ng-animate-disabled,.ng-animate-disabled .mat-expansion-panel,.mat-expansion-panel._mat-animation-noopable{transition:none}.mat-expansion-panel-content{display:flex;flex-direction:column;overflow:visible}.mat-expansion-panel-body{padding:0 24px 16px}.mat-expansion-panel-spacing{margin:16px 0}.mat-accordion>.mat-expansion-panel-spacing:first-child,.mat-accordion>*:first-child:not(.mat-expansion-panel) .mat-expansion-panel-spacing{margin-top:0}.mat-accordion>.mat-expansion-panel-spacing:last-child,.mat-accordion>*:last-child:not(.mat-expansion-panel) .mat-expansion-panel-spacing{margin-bottom:0}.mat-action-row{border-top-style:solid;border-top-width:1px;display:flex;flex-direction:row;justify-content:flex-end;padding:16px 8px 16px 24px}.mat-action-row button.mat-button-base,.mat-action-row button.mat-mdc-button-base{margin-left:8px}[dir=rtl] .mat-action-row button.mat-button-base,[dir=rtl] .mat-action-row button.mat-mdc-button-base{margin-left:0;margin-right:8px}\n"],encapsulation:2,data:{animation:[U.bodyExpansion]},changeDetection:0}),e})(),S=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({imports:[[o.ez,m.BQ,g,u.eL]]}),e})();var M=n(2730),E=n(1990),B=n(293),D=n(5106);let z=(()=>{class e{constructor(){}ngOnInit(){}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275cmp=i.Xpm({type:e,selectors:[["ll-product-details"]],decls:123,vars:0,consts:[[1,"mt-32"],[1,"container"],[1,"grid","grid-cols-12","gap-8"],[1,"col-span-12","md:col-span-7","xl:col-span-8","border","p-5"],["href","javascript:void(0)",1,"category","text-primary","inline-block","mb-5"],[1,"_title","font-medium"],[1,"product-meta","flex","flex-wrap","items-center","mt-8","mb-8"],[1,"mr-4"],["href","javascript:void(0)",1,"flex","items-center","pr-4","py-1","hover:text-primary"],["color","warn",1,"mr-2"],[1,"mr-2"],["src","assets/images/products/details.jpg","alt","img not found",1,"w-full"],[1,"ll-content","mt-8"],[1,"col-span-12","md:col-span-5","xl:col-span-4"],[1,"border"],[1,"border-b","text-center","pt-10","pb-10"],[1,"text-accent","text-4xl","font-semibold"],[1,"font-medium","text-lg","mt-3","text-gray-400","tracking-wider"],[1,"border-b","p-5"],[1,"service-info"],[1,"py-2","mr-2"],[1,"flex","items-center"],[1,"text-primary","border-2","rounded-full","w-6","h-6","text-center","leading-5","mr-2"],[1,"mr-2","font-black"],[1,"flex","mt-2"],[1,"sm:pt-1","mr-3","sm:mr-6","md:mr-8"],["type","checkbox",1,"appearance-none","border","border-gray-300","checked:bg-gray-400","checked:border-transparent","..."],[1,"flex-grow"],[1,"price","sm:float-right","font-bold"],[1,"text-gray-800"],[1,"mt-2"],[1,"flex","mt-4"],[1,"border-b","px-5","pt-10","pb-12","text-center"],[1,"text-gray-400","mb-4"],["mat-flat-button","","color","accent",1,"py-3","px-20","text-xl","font-bold"],[1,"border","mt-5","px-5","py-10","text-center"],[1,"font-bold","mb-3"],["mat-stroked-button","",1,"py-2","px-12","text-lg","font-bold","text-gray-700"]],template:function(e,t){1&e&&(i.TgZ(0,"div",0),i.TgZ(1,"div",1),i.TgZ(2,"div",2),i.TgZ(3,"div",3),i.TgZ(4,"a",4),i._uU(5,"Personal"),i.qZA(),i.TgZ(6,"h1",5),i._uU(7,"Potential analysis - digitization for manufacturing companies"),i.qZA(),i.TgZ(8,"ul",6),i.TgZ(9,"li",7),i.TgZ(10,"a",8),i.TgZ(11,"mat-icon",9),i._uU(12,"start"),i.qZA(),i._uU(13," 4.5/5 (14 Feedback)"),i.qZA(),i.qZA(),i.TgZ(14,"li",7),i.TgZ(15,"a",8),i.TgZ(16,"mat-icon",10),i._uU(17,"favorite"),i.qZA(),i._uU(18," Save"),i.qZA(),i.qZA(),i.TgZ(19,"li",7),i.TgZ(20,"a",8),i.TgZ(21,"mat-icon",10),i._uU(22,"share"),i.qZA(),i._uU(23," Share"),i.qZA(),i.qZA(),i.qZA(),i._UZ(24,"img",11),i.TgZ(25,"div",12),i.TgZ(26,"h5"),i._uU(27," We provide you with process mechanics for plastics and rubber technology (m / f / d) from Spain. Our candidates speak English and would like to continue their respective careers in the plastics country. "),i.qZA(),i.TgZ(28,"h6"),i._uU(29,"Problem"),i.qZA(),i.TgZ(30,"p"),i._uU(31," It is difficult to find talented & motivated process mechanics in Germany. Lateral entrants from Germany can work, but the best are those talents who have learned the process from scratch and can & want to imagine a career with it. "),i.qZA(),i.TgZ(32,"h6"),i._uU(33,"General situation:"),i.qZA(),i.TgZ(34,"p"),i._uU(35," Many production companies in plastics processing in Germany have been experiencing a shortage of talented and motivated process mechanics for years. Only a few small and medium-sized companies actively use the talent pool from other EU countries. Many process mechanics in other EU countries would like to continue their careers in Germany. Small and medium-sized teams in particular offer such talents a warm atmosphere and the chance to feel at home. "),i.qZA(),i.TgZ(36,"h6"),i._uU(37,"Our solution:"),i.qZA(),i.TgZ(38,"p"),i._uU(39," We are looking for suitable process mechanics from Spain who speak good English according to your requirement profile and support you in welcoming your ideal candidate to Germany even during the pandemic. Basically, the European population under the age of 30, and especially those with an affinity for technology and machines, speak good to very good English. You should benefit. "),i.qZA(),i.TgZ(40,"h6"),i._uU(41,"What you get with this booking and for this price:"),i.qZA(),i.TgZ(42,"ul"),i.TgZ(43,"li"),i._uU(44," The successful placement of a process mechanic (m / f / d) according to your requirement profile for permanent employment "),i.qZA(),i.TgZ(45,"li"),i._uU(46,"The placement of a process mechanic (m / f / d) exclusively from Spain with a work permit for foeign countries"),i.qZA(),i.TgZ(47,"li"),i._uU(48,"Placement of talents with a good command of English"),i.qZA(),i.qZA(),i.TgZ(49,"blockquote"),i._uU(50," And talk about chicken nuggets and bacon BBQ souces. AND talk about chicken nuggets and bacon BBQ souces. AND talk about chicken nuggets and bacon BBQ souces "),i.qZA(),i.TgZ(51,"h6"),i._uU(52,"Requirements:"),i.qZA(),i.TgZ(53,"ol"),i.TgZ(54,"li"),i._uU(55," You have to create the prerequisites in the factory & company to integrate a process mechanic who initially only speaks English. "),i.qZA(),i.TgZ(56,"li"),i._uU(57,"We need a realistic requirement profile that takes into account the professional or differences in training in Spain."),i.qZA(),i.qZA(),i.TgZ(58,"blockquote"),i._uU(59," And talk about chicken nuggets and bacon BBQ souces. AND talk about chicken nuggets and bacon BBQ souces. AND talk about chicken nuggets and bacon BBQ souces "),i.qZA(),i.qZA(),i.qZA(),i.TgZ(60,"div",13),i.TgZ(61,"div",14),i.TgZ(62,"div",15),i.TgZ(63,"div",16),i._uU(64,"\u20ac3,000.00"),i.qZA(),i.TgZ(65,"div",17),i._uU(66,"Price"),i.qZA(),i.qZA(),i.TgZ(67,"div",18),i.TgZ(68,"ul",19),i.TgZ(69,"li",20),i.TgZ(70,"div",21),i.TgZ(71,"mat-icon",22),i._uU(72,"check"),i.qZA(),i.TgZ(73,"strong",23),i._uU(74,"96"),i.qZA(),i._uU(75," interested persons "),i.qZA(),i.qZA(),i.TgZ(76,"li",20),i.TgZ(77,"div",21),i.TgZ(78,"mat-icon",22),i._uU(79,"check"),i.qZA(),i.TgZ(80,"strong",23),i._uU(81,"1 hours"),i.qZA(),i._uU(82," reaction time "),i.qZA(),i.qZA(),i.TgZ(83,"li",20),i.TgZ(84,"div",21),i.TgZ(85,"mat-icon",22),i._uU(86,"check"),i.qZA(),i.TgZ(87,"strong",23),i._uU(88,"12 hours"),i.qZA(),i._uU(89," delivery time "),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.TgZ(90,"div",18),i.TgZ(91,"h5"),i._uU(92,"Addons Services"),i.qZA(),i.TgZ(93,"div",24),i.TgZ(94,"div",25),i._UZ(95,"input",26),i.qZA(),i.TgZ(96,"div",27),i.TgZ(97,"div",28),i._uU(98,"\u20ac200.00"),i.qZA(),i.TgZ(99,"h6",29),i._uU(100,"Execution after work"),i.qZA(),i.TgZ(101,"p",30),i._uU(102," Thanks to our home office approach, we can serve you during the entire microservice even after work, if that suits you better. The following times are possible after close of business: sun - thu, 9 p.m. - 7 p.m. "),i.qZA(),i.qZA(),i.qZA(),i.TgZ(103,"div",31),i.TgZ(104,"div",25),i._UZ(105,"input",26),i.qZA(),i.TgZ(106,"div",27),i.TgZ(107,"div",28),i._uU(108,"\u20ac200.00"),i.qZA(),i.TgZ(109,"h6",29),i._uU(110,"Execution after work"),i.qZA(),i.TgZ(111,"p",30),i._uU(112," Thanks to our home office approach, we can serve you during the entire microservice even after work, if that suits you better. The following times are possible after close of business: sun - thu, 9 p.m. - 7 p.m. "),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.TgZ(113,"div",32),i.TgZ(114,"p",33),i._uU(115,"This price can increase due to additional bookings"),i.qZA(),i.TgZ(116,"button",34),i._uU(117,"Buy now"),i.qZA(),i.qZA(),i.qZA(),i.TgZ(118,"div",35),i.TgZ(119,"p",36),i._uU(120,"Do you have any special requirements?"),i.qZA(),i.TgZ(121,"button",37),i._uU(122,"Send us"),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA())},directives:[B.Hw,D.lW],styles:[".product-meta[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]{color:#848484;border-right:1px solid #d6d6d6}.product-meta[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]:last-child{border:0}.ll-content[_ngcontent-%COMP%]   h2[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   h5[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   h6[_ngcontent-%COMP%]{margin-bottom:10px;margin-top:30px}.ll-content[_ngcontent-%COMP%]   p[_ngcontent-%COMP%]{margin-bottom:15px;color:#7c7777}.ll-content[_ngcontent-%COMP%]   dl[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   ol[_ngcontent-%COMP%], .ll-content[_ngcontent-%COMP%]   ul[_ngcontent-%COMP%]{padding-left:1.25rem;list-style-position:outside}.ll-content[_ngcontent-%COMP%]   ul[_ngcontent-%COMP%]{list-style-type:disc}.ll-content[_ngcontent-%COMP%]   ol[_ngcontent-%COMP%]{list-style-type:decimal}.ll-content[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]{color:#7c7777;padding:3px 0}.ll-content[_ngcontent-%COMP%]   blockquote[_ngcontent-%COMP%]{background-color:#f3f3f3;padding:20px;margin-bottom:20px;margin-top:20px}.service-info[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]{color:#767676;font-size:.85rem;display:inline-block}.service-info[_ngcontent-%COMP%]   .mat-icon[_ngcontent-%COMP%]{font-size:14px}@media (min-width:992px) and (max-width:1199px){._title[_ngcontent-%COMP%]{font-size:2rem}}@media (max-width:991px){._title[_ngcontent-%COMP%]{font-size:1.7rem;line-height:2.7rem}}"]}),e})();var Q=n(4040);let j=(()=>{class e{constructor(){this.particlesOptions={particles:{color:{value:["#ffffff","#ffffff"]},size:{value:1},lineLinked:{enable:!0,color:"random"},move:{enable:!0,speed:1}}}}ngOnInit(){}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275cmp=i.Xpm({type:e,selectors:[["ll-product-hero"]],decls:12,vars:2,consts:[[1,"_hero","pb-10","mt-32","overflow-hidden"],[1,"container"],[1,"_hero__content","px-8","text-white"],[1,"grid","grid-cols-12","relative","z-10"],[1,"col-span-12","md:col-span-7","xl:col-span-8","xxl:col-span-9","py-16"],[1,"font-medium"],["routerLink","/auth/signup","mat-raised-button","","color","warn",1,"mt-8","px-8","py-3","text-lg","font-semibold"],[1,"md:col-span-5","xl:col-span-4","xxl:col-span-3","hidden","md:flex","items-end"],["src","assets/images/female.png","alt",""],[1,"_hero__particles","hidden","md:block",3,"id","options"]],template:function(e,t){1&e&&(i.TgZ(0,"div",0),i.TgZ(1,"div",1),i.TgZ(2,"div",2),i.TgZ(3,"div",3),i.TgZ(4,"div",4),i.TgZ(5,"h2",5),i._uU(6,"Discover the microservices that will take your production forward today"),i.qZA(),i.TgZ(7,"a",6),i._uU(8,"Start Now"),i.qZA(),i.qZA(),i.TgZ(9,"div",7),i._UZ(10,"img",8),i.qZA(),i.qZA(),i._UZ(11,"ng-particles",9),i.qZA(),i.qZA(),i.qZA()),2&e&&(i.xp6(11),i.Q6J("id","product_hero")("options",t.particlesOptions))},directives:[E.yS,D.zs,M.nH],styles:["._hero__content[_ngcontent-%COMP%]{background-color:#5d0f29;position:relative}._hero__particles[_ngcontent-%COMP%]{position:absolute;top:0;left:0;bottom:0;right:0}"]}),e})();var I=n(5731);const R=function(e){return["/products",e]};function N(e,t){if(1&e&&(i.TgZ(0,"div",31),i.TgZ(1,"mat-card",32),i._UZ(2,"img",33),i.TgZ(3,"mat-card-content",34),i.TgZ(4,"div",35),i._UZ(5,"img",36),i.qZA(),i.TgZ(6,"div",37),i.TgZ(7,"h4",38),i._uU(8),i.qZA(),i.TgZ(9,"h2",39),i.TgZ(10,"a",40),i._uU(11),i.qZA(),i.qZA(),i.TgZ(12,"div",41),i.TgZ(13,"div",42),i._uU(14,"Prices:"),i.qZA(),i.TgZ(15,"div",43),i._uU(16),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.TgZ(17,"mat-card-actions",44),i.TgZ(18,"div",45),i.TgZ(19,"mat-icon",46),i._uU(20,"star"),i.qZA(),i._uU(21),i.qZA(),i.TgZ(22,"div",47),i.TgZ(23,"a",48),i._uU(24,"Read More"),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA()),2&e){const e=t.$implicit;i.xp6(2),i.s9C("alt",e.name),i.Q6J("src",null==e?null:e.images[0],i.LSH),i.xp6(3),i.s9C("src",null==e||null==e.created_by?null:e.created_by.avatar,i.LSH),i.xp6(3),i.Oqu(null==e||null==e.created_by?null:e.created_by.name),i.xp6(2),i.Q6J("routerLink",i.VKq(9,R,e.id)),i.xp6(1),i.Oqu(e.name),i.xp6(5),i.hij("\u20ac",e.price,""),i.xp6(5),i.hij(" ",e.rating,"/5 "),i.xp6(2),i.Q6J("routerLink",i.VKq(11,R,e.id))}}const Y=[{path:"",component:(()=>{class e{constructor(){this.advanceSearchExpanded=!1,this.products=[]}ngOnInit(){this.products=Q.Z.Product}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275cmp=i.Xpm({type:e,selectors:[["ll-product-list"]],decls:75,vars:2,consts:[[1,"ll-search","pb-6"],[1,"container"],[1,"border","overflow-hidden","sm:rounded-md","p-5"],[1,"mb-3"],[1,"flex","justify-between","flex-wrap"],["mat-button","",3,"click"],[1,"mt-3","flex"],["type","text","placeholder","I am looking for ...","required","",1,"flex-1","w-full","sm:text-sm","lg:text-xl","border-gray-300","rounded-l-md","py-3","px-6"],[1,"bg-primary","w-24","rounded-r-md"],[1,"leading-8"],[3,"expanded"],[1,"grid","grid-cols-6","gap-6","mt-4"],[1,"col-span-6","sm:col-span-3"],["type","text","placeholder","Start price",1,"mt-1","focus:ring-indigo-500","focus:border-indigo-500","block","w-full","shadow-sm","sm:text-sm","border-gray-300","rounded-md"],["type","text","placeholder","End price",1,"mt-1","focus:ring-indigo-500","focus:border-indigo-500","block","w-full","shadow-sm","sm:text-sm","border-gray-300","rounded-md"],["name","categories",1,"mt-1","block","w-full","py-2","px-3","border","border-gray-300","bg-white","rounded-md","shadow-sm","focus:outline-none","focus:ring-indigo-500","focus:border-indigo-500","sm:text-sm"],["name","rating",1,"mt-1","block","w-full","py-2","px-3","border","border-gray-300","bg-white","rounded-md","shadow-sm","focus:outline-none","focus:ring-indigo-500","focus:border-indigo-500","sm:text-sm"],[1,"col-span-6"],["mat-flat-button","","color","accent"],[1,"ll-products-area","mb-24"],[1,"grid","grid-cols-12","gap-6","xxl:gap-8"],["class","col-span-12 md:col-span-6 xl:col-span-4",4,"ngFor","ngForOf"],[1,"ll-find-more","mt-10","mb-36"],[1,"container","rounded-md"],[1,"ll-find-more__heading"],[1,"grid","grid-cols-1","md:grid-cols-2","gap-8","mt-8"],[1,"_card","bg-white","rounded-md"],[1,"_card__title","font-normal","text-black"],[1,"_card__paragraph","font-light","text-black","mt-3"],["href","","mat-fab","","color","warn",1,"float-right","mt-"],[1,"_card","bg-white","rounded-md","ml-auto"],[1,"col-span-12","md:col-span-6","xl:col-span-4"],[1,"ll-product"],["mat-card-image","",2,"width","100%","margin","0 0 20px",3,"src","alt"],[1,"flex"],[1,"flex-none","w-10"],["alt","product?.created_by?.name",3,"src"],[1,"flex-grow","pl-3"],[1,"ll-product__creator"],[1,"ll-product__name"],[3,"routerLink"],[1,"flex","justify-between","mt-5"],[1,"ll-product__price-label"],[1,"ll-product__price","text-accent","font-bold"],[1,"ll-product__action","flex","justify-between"],[1,"flex-1","text-center","flex","items-center","justify-center"],["color","warn"],[1,"flex-1","text-center"],["mat-raised-button","","color","warn",1,"px-4",3,"routerLink"]],template:function(e,t){1&e&&(i._UZ(0,"ll-product-hero"),i.TgZ(1,"div",0),i.TgZ(2,"div",1),i.TgZ(3,"div",2),i.TgZ(4,"div",3),i.TgZ(5,"div",4),i.TgZ(6,"h4"),i._uU(7,"Find your need"),i.qZA(),i.TgZ(8,"button",5),i.NdJ("click",function(){return t.advanceSearchExpanded=!t.advanceSearchExpanded}),i.TgZ(9,"mat-icon"),i._uU(10,"tune"),i.qZA(),i._uU(11," ADVANCED SEARCH"),i.qZA(),i.qZA(),i.TgZ(12,"div",6),i._UZ(13,"input",7),i.TgZ(14,"button",8),i.TgZ(15,"mat-icon",9),i._uU(16,"search"),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.TgZ(17,"mat-expansion-panel",10),i.TgZ(18,"div",11),i.TgZ(19,"div",12),i._UZ(20,"input",13),i.qZA(),i.TgZ(21,"div",12),i._UZ(22,"input",14),i.qZA(),i.TgZ(23,"div",12),i.TgZ(24,"select",15),i.TgZ(25,"option"),i._uU(26,"Category"),i.qZA(),i.TgZ(27,"option"),i._uU(28,"Microservices"),i.qZA(),i.TgZ(29,"option"),i._uU(30,"Shipping Service"),i.qZA(),i.TgZ(31,"option"),i._uU(32,"Consulting"),i.qZA(),i.qZA(),i.qZA(),i.TgZ(33,"div",12),i.TgZ(34,"select",16),i.TgZ(35,"option"),i._uU(36,"Rating"),i.qZA(),i.TgZ(37,"option"),i._uU(38,"1"),i.qZA(),i.TgZ(39,"option"),i._uU(40,"2"),i.qZA(),i.TgZ(41,"option"),i._uU(42,"3"),i.qZA(),i.TgZ(43,"option"),i._uU(44,"4"),i.qZA(),i.TgZ(45,"option"),i._uU(46,"5"),i.qZA(),i.qZA(),i.qZA(),i.TgZ(47,"div",17),i.TgZ(48,"button",18),i._uU(49,"Apply filter"),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.TgZ(50,"div",19),i.TgZ(51,"div",1),i.TgZ(52,"div",20),i.YNc(53,N,25,13,"div",21),i.qZA(),i.qZA(),i.qZA(),i.TgZ(54,"div",22),i.TgZ(55,"div",23),i.TgZ(56,"h2",24),i._uU(57,"Didn't find what you were looking for? There is more we can do for you."),i.qZA(),i.TgZ(58,"div",25),i.TgZ(59,"div",26),i.TgZ(60,"h3",27),i._uU(61,"Post Requirements and let our consultants make an individual offer"),i.qZA(),i.TgZ(62,"h5",28),i._uU(63,"Talent marketplace"),i.qZA(),i.TgZ(64,"a",29),i.TgZ(65,"mat-icon"),i._uU(66,"arrow_forward"),i.qZA(),i.qZA(),i.qZA(),i.TgZ(67,"div",30),i.TgZ(68,"h3",27),i._uU(69,"Post a problem and we will look for talented and skillful suitable advisors."),i.qZA(),i.TgZ(70,"h5",28),i._uU(71,"Scouting"),i.qZA(),i.TgZ(72,"a",29),i.TgZ(73,"mat-icon"),i._uU(74,"arrow_forward"),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA(),i.qZA()),2&e&&(i.xp6(17),i.Q6J("expanded",t.advanceSearchExpanded),i.xp6(36),i.Q6J("ngForOf",t.products))},directives:[j,D.lW,B.Hw,P,o.sg,D.zs,I.a8,I.G2,I.dn,E.yS,I.hq],styles:[""]}),e})()},{path:":id",component:z}];let L=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({imports:[[E.Bz.forChild(Y)],E.Bz]}),e})();var J=n(5289);let G=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({imports:[[o.ez,L,J.m,S,M.Ae]]}),e})()}}]);