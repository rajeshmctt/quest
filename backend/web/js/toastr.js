/*!
 * Remark (http://getbootstrapadmin.com/remark)
 * Copyright 2016 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
$.components.register("toastr",{mode:"api",api:function(){if("undefined"!=typeof toastr){var defaults=$.components.getDefaults("toastr");$(document).on("click.site.toastr",'[data-plugin="toastr"]',function(e){e.preventDefault();var $this=$(this),options=$.extend(!0,{},defaults,$this.data()),message=options.message||"",type=options.type||"info",title=options.title||void 0;switch(type){case"success":toastr.success(message,title,options);break;case"warning":toastr.warning(message,title,options);break;case"error":toastr.error(message,title,options);break;case"info":toastr.info(message,title,options);break;default:toastr.info(message,title,options)}})}}});