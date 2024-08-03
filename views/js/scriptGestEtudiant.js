$(function(){
    $(".listEtudiants").click(function(){
        $(this).addClass("bg-principal")
        $(".Demandes").removeClass("bg-principal")
        $(".etudiants").fadeIn()
        $(".demandes").fadeOut()
    });
    $(".Demandes").click(function(){
        $(this).addClass("bg-principal")
        $(".listEtudiants").removeClass("bg-principal")
        $(".etudiants").fadeOut()
        $(".demandes").fadeIn()
    });

    $(".approuver").click(function(){
        let id = $(this).attr("data-id")
        let xhr = new XMLHttpRequest()
        let target = "../modeles/approve.php?id="+id
        xhr.open('GET',target)
        xhr.send()
        xhr.onreadystatechange = () =>{
            if(xhr.status == 200 && xhr.readyState == 4){
                $("#"+$(this).attr("data-id")).fadeOut()
            }
        }
    })
    $(".rejeter").click(function(){
        let id = $(this).attr("data-id")
        let xhr = new XMLHttpRequest()
        let target = "../modeles/reject.php?id="+id
        xhr.open('GET',target)
        xhr.send()
        xhr.onreadystatechange = () =>{
            if(xhr.status == 200 && xhr.readyState == 4){
                $("#"+$(this).attr("data-id")).fadeOut()
            }
        }
    })
    $(".modifEtudiant").click(function(){
        
        let userName = $(this).attr("data-userName")
        let email = $(this).attr("data-email")
        let numero = $(this).attr("data-matricule")
        let telephone = $(this).attr("data-telephone")
        let adresse = $(this).attr("data-adresse")
        let sexe = $(this).attr("data-sexe")
        let classe = $(this).attr("data-classe")
        let id = $(this).attr("data-id")

        $("#id").attr("value",id)
        $("#username").attr("value",userName)        
        $("#emailInst").attr("value",email)
        $("#numCarte").attr("value",numero)
        $("#telephone").attr("value",telephone)
        $("#adresse").attr("value",adresse)
        $("#F").val("F")
        $("#M").val("M")
        $("#src").val("prof")

        if(sexe == "F")
            $("#F").attr("checked",true)
        else
            $("#M").attr("checked",true)

        $("#"+classe).attr("selected",true)

        $('.formModif').attr('action',"../modeles/modifEtudiant.php")
    })

})
