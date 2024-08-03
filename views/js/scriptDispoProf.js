$(function(){
    $(".addDispo").click(function(){
        $("#jour").attr("value",$(this).attr("data-jour"))
        $("#debut").attr("value",$(this).attr("data-debut"))
        $("#fin").attr("value",$(this).attr("data-fin"))
    })
})