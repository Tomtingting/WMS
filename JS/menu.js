
var toggleMenu={
    init : function(sContainerClass,sHiddenClass){
        if(!document.getElementById || !document.createTextNode) {return;}//Check for DOM support
        var arrMenus = this.getElementsByClassName(document,'ul',sContainerClass);//Find all menus
        var arrSubMenus,oSubMenu,oLink;
        for (var i=0;i<arrMenus.length;i++){//In each menu...
        arrSubMenus=arrMenus[i].getElementsByTagName('ul');//...find all sub menus
        for(var j=0;j<arrSubMenus.length;j++){//For each menu...
            oSubMenu=arrSubMenus[j];
        oLink = oSubMenu.parentNode.getElementsByTagName('a')[0];//...find the link that toggles it
        oLink.onclick=function()
        {toggleMenu.toggle(this.parentNode.getElementsByTagName('ul')[0],sHiddenClass);return false;}//...add an event handler to the link
        this.toggle(oSubMenu,sHiddenClass);//...and hide the sub
        }
    }
},
    toggle : function(el,sHiddenClass){
        var oRegExp=new RegExp("(|\\s)"+sHiddenClass+"(|\\s)");
        el.className=(oRegExp.test(el.className))?el.className.replace(oRegExp,''):
        el.className+''+sHiddenClass;//Add or remove the class name that hides the elment
         },
    addEvent :function(obj,type,fn){
        if (obj.addEventListener)
            obj.addEventListener(type,fn,false);
        else if (obj.attachEvent){
            obj["e"+type+fn]=fn;
            obj[type+fn]=function() {obj["e"+type+fn](window.event);}
            obj.attachEvent("on"+type,obj[type+fn]);
        }
    },
    getElementsByClassName:function(oElm,strTagName,strClassName){
        var arrElements=(strTagName=="*"&&document.all)?document.all : oElm.getElementsByTagName(strTagName);
        var arrReturnElements=new Array();
        strClassName=strClassName.replace(/\-/g,"\\-");
        var oRegExp =new RegExp("(|\\s)"+strClassName+"(\\s|$)");
        var oElement;
        for (var i=0;i<arrElements.length;i++){
            oElement=arrElements[i];
            if(oRegExp.test(oElement.className)){
                arrReturnElements.push(oElement);
            }
        }
        return(arrReturnElements)
    }
};
toggleMenu.addEvent(window,'load',function(){toggleMenu.init('menu','hidden');});
