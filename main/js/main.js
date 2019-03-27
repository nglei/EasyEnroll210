function sidemenuout(){
    //slide content away to fit in sidepanel menu
    document.getElementById("clickonmenu").style.width="250px";
    document.getElementById("main").style.marginLeft="250px";
}
function closemenu(){
    //close the menu the content is slided back
    document.getElementById("clickonmenu").style.width="0px";
    document.getElementById("main").style.marginLeft="0px";
}