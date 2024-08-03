$(function(){
    $(".loSrc").click(function(){
        $(".confLogOut").fadeIn().css("display", "flex");
        $(".bg-floue").fadeIn()
    })
    $(".loAnn").click(function(){
        $(".confLogOut").fadeOut()
        $(".bg-floue").fadeOut()
    })
})