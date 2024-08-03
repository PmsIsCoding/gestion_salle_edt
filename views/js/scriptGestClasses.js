$(function(){
    $(".modifClass").click(function(){
        let classeId = $(this).attr("data-id");
        let nomclasse = $(this).attr("data-classe");
        let profId= $(this).attr("data-prof-id");
        
        $(".modaleForm").attr("action","../modeles/MAJClasses.php")

        $("#classe_id").attr("value",classeId);
        $("#nom_classe").attr("value",nomclasse);
        $("#prof_responsable_id").attr("value",profId);
        $("#default").attr("selected",false)
        $("#"+profId).attr("selected",true)
    })
})