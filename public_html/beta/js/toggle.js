$(document).ready(function(){
    var $menuToggle = $("#menu-toggle");
    var $subMenuToggle = $("#sub-menu-toggle");
    $menuToggle.change(function(){
        if(!(this.checked)){
            $subMenuToggle.prop("checked", false);
        }
    });
});