$(function(){
    $(".modaleSrc").click(function(){
        $(".modaleForm").fadeIn()
        $(".modaleForm").attr("action","../modeles/add"+$(this).attr("data-option")+".php")
        $(".modaleForm input").attr("value","")
        $(".modaleForm").css("display","flex")
        $(".bg-floue").fadeIn()
    })
    $(".btn-ann").click(function(){
        $(".modaleForm").fadeOut()
        $(".modaleDel").fadeOut()
        $(".bg-floue").fadeOut()
    })
    $(".delSrc").click(function(){
        $(".modaleDel").fadeIn()
        $(".bg-floue").fadeIn()
        $(".modaleDel").css("display","flex")
    })
})