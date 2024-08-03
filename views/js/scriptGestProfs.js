$(function(){
    $(".modifProfs").click(function(){
        $(".addProf").attr("action","../modeles/modifProf.php")
        $("#idProf").attr("value",$(this).attr("data-id"))
        
        $("#matricule").attr("value",$(this).attr("data-matricule"))
        $("#email").attr("value",$(this).attr("data-email"))
        $("#userName").attr("value",$(this).attr("data-userName"))
        $("#matricule").attr("value",$(this).attr("data-matricule"))
        $("#specialite").attr("value",$(this).attr("data-specialite"))
    })
})