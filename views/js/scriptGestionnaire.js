$(function(){
    $(".modifGest").click(function(){
        
        $(".addGest").attr("action","../modeles/modifGest.php")
        $("#id").attr("value",$(this).attr("data-id"))
        $("#matricule").attr("value",$(this).attr("data-matricule"))
        $("#email").attr("value",$(this).attr("data-email"))
        $("#userName").attr("value",$(this).attr("data-userName"))
        $("#matricule").attr("value",$(this).attr("data-matricule"))
    })
})