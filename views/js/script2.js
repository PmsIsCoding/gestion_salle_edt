// $(function(){
//     $(".listEtudiants").click(function(){
//         $(this).addClass("bg-principal")
//         $(".Demandes").removeClass("bg-principal")
//         $(".etudiants").fadeIn()
//         $(".demandes").fadeOut()
//     });
//     $(".Demandes").click(function(){
//         $(this).addClass("bg-principal")
//         $(".listEtudiants").removeClass("bg-principal")
//         $(".etudiants").fadeOut()
//         $(".demandes").fadeIn()
//     });

//     $(".approuver").click(function(){
//         let id = $(this).attr("data-id")
//         let xhr = new XMLHttpRequest()
//         let target = "../modeles/approve.php?id="+id
//         xhr.open('GET',target)
//         xhr.send()
//         xhr.onreadystatechange = () =>{
//             if(xhr.status == 200 && xhr.readyState == 4){
//                 $("#"+$(this).attr("data-id")).fadeOut()
//             }
//         }
//     })
//     $(".rejeter").click(function(){
//         let id = $(this).attr("data-id")
//         let xhr = new XMLHttpRequest()
//         let target = "../modeles/reject.php?id="+id
//         xhr.open('GET',target)
//         xhr.send()
//         xhr.onreadystatechange = () =>{
//             if(xhr.status == 200 && xhr.readyState == 4){
//                 $("#"+$(this).attr("data-id")).fadeOut()
//             }
//         }
//     })

//     $(".btn-ann").click(function(){
//         $(".confDelete").fadeOut()
//         $(".bg-floue").fadeOut()
//         $(".formModif").fadeOut()
//     })
//     $(".supprimer").click(function(){
//         $(".confDelete").fadeIn()
//         $(".confDelete").css("display","flex")
//         let target = "../modeles/delete.php?id="+$(this).attr("data-id")
//         $(".btns a").attr("href",target)
//         $(".bg-floue").fadeIn()
//     })
//     $(".modifEtudiant").click(function(){
//         $(".formModif").fadeIn()
//         $(".bg-floue").fadeIn()

//         let userName = $(this).attr("data-userName")
//         let email = $(this).attr("data-email")
//         let numero = $(this).attr("data-matricule")
//         let telephone = $(this).attr("data-telephone")
//         let adresse = $(this).attr("data-adresse")
//         let sexe = $(this).attr("data-sexe")
//         let classe = $(this).attr("data-classe")
//         let id = $(this).attr("data-id")

//         $("#id").attr("value",id)
//         $("#username").attr("value",userName)        
//         $("#emailInst").attr("value",email)
//         $("#numCarte").attr("value",numero)
//         $("#telephone").attr("value",telephone)
//         $("#adresse").attr("value",adresse)
//         if(sexe == "F")
//             $("#F").attr("checked",true)
//         else
//             $("#M").attr("checked",true)

//         $("#"+classe).attr("selected",true)
//     })

//     $(".modifier").click(function(){
//         $("#formClass").fadeIn()
//         $(".bg-floue").fadeIn()

//         let classeId = $(this).attr("data-id");
//         let nomclasse = $(this).attr("data-classe");
//         let profId= $(this).attr("data-prof-id");
        
//         $("#classe_id").attr("value",classeId);
//         $("#nom_classe").attr("value",nomclasse);
//         $("#prof_responsable_id").attr("value",profId);
//         // $("#classe_id").val(classeId);
//         // $("#nom_classe").val(nomclasse);
//         // $("#prof_responsable_id").val(profId);
//     });

//     $(".btn-ann").click(function(){
//         $("#formClass").fadeOut()
//         $(".bg-floue").fadeOut()
//     });


//     $(".ajoutClasse").click(function(){
//         $("#formAjoutClasse").fadeIn();
//         $(".bg-floue").fadeIn();
//     });

//     $(".btn-ann").click(function(){
//         $("#formAjoutClasse").fadeOut();
//         $(".bg-floue").fadeOut();
//     });


//     $(".supprimerClass").click(function(){
//         $("#supprimerClass").fadeIn()
//         $("#formSupprimerClass").fadeIn();
//         $(".supprimerClass").css("display","flex")
//         let target = "../modeles/deleteClass.php?id="+$(this).attr("data-id")
//         $(".btns a").attr("href",target)
//         $(".bg-floue").fadeIn()

//         let classId = $(this).attr("data-id");
//         let nomclasse = $(this).attr("data-classe");
//         $("#classe_idSupprimer").attr("value",classId);
//         $("#nom_classe").attr("value",nomclasse);


//     })
//     $(".btn-annClass").click(function(){
//         $("#supprimerClass").fadeOut()
//         $("#formSupprimerClass").fadeOut()
//         $(".bg-floue").fadeOut()
//     });

// })