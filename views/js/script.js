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
//         $(".confDeleteProf").fadeOut()
//         $(".bg-floue").fadeOut()
//     })
//     $(".supprimer").click(function(){
//         $(".confDelete").fadeIn()
//         $(".confDelete").css("display","flex")
//         let target = "../modeles/delete.php?id="+$(this).attr("data-id")
//         $(".btns a").attr("href",target)
//         $(".bg-floue").fadeIn()
//         $(".confDeleteProf").fadeIn()
//     })
//     $(".ann").click(function(){
//         $(".bg-floue").fadeOut()
//         $(".addProf").fadeOut()
//         $(".addGest").fadeOut()
//     })
//     $(".ajout-prof").click(function(){
//         $(".bg-floue").fadeIn()
//         $(".addProf").fadeIn()
//         $(".addProf").attr("action","../modeles/addProf.php")

//         $("#matricule").attr("value","")
//         $("#email").attr("value","")
//         $("#userName").attr("value","")
//         $("#matricule").attr("value","")
//         $("#specialite").attr("value","")
//     })
//     $(".modifProfs").click(function(){
//         $(".bg-floue").fadeIn()
//         $(".addProf").fadeIn()
//         $(".addProf").attr("action","../modeles/modifProf.php")
//         $("#idProf").attr("value",$(this).attr("data-id"))
        
//         $("#matricule").attr("value",$(this).attr("data-matricule"))
//         $("#email").attr("value",$(this).attr("data-email"))
//         $("#userName").attr("value",$(this).attr("data-userName"))
//         $("#matricule").attr("value",$(this).attr("data-matricule"))
//         $("#specialite").attr("value",$(this).attr("data-specialite"))
//     })
//     $(".supprimerProf").click(function(){
//         $(".confDelete").fadeIn()
//         $(".confDelete").css("display","flex")
//         let target = "../modeles/delete.php?id="+$(this).attr("data-id")+"&option=professeur"
//         $(".btns a").attr("href",target)
//         $(".bg-floue").fadeIn()
//         $(".confDeleteProf").fadeIn()
//     })
//     $(".addGestionnaire").click(function(){
//         $(".addGest").fadeIn()
//         $(".bg-floue").fadeIn()

//         $(".addGest").attr("action","../modeles/addGest.php")
//         $("#id").attr("value","")
//         $("#matricule").attr("value","")
//         $("#email").attr("value","")
//         $("#userName").attr("value","")
//         $("#matricule").attr("value","")
//     })
//     $(".modifGest").click(function(){
//         $(".addGest").fadeIn()
//         $(".bg-floue").fadeIn()

//         $(".addGest").attr("action","../modeles/modifGest.php")
//         $("#id").attr("value",$(this).attr("data-id"))
//         $("#matricule").attr("value",$(this).attr("data-matricule"))
//         $("#email").attr("value",$(this).attr("data-email"))
//         $("#userName").attr("value",$(this).attr("data-userName"))
//         $("#matricule").attr("value",$(this).attr("data-matricule"))
//     })

//     $(".deleteGest").click(function(){
//         $(".confDelete").fadeIn()
//         $(".confDelete").css("display","flex")
//         let target = "../modeles/delete.php?id="+$(this).attr("data-id")+"&option=gestionnaire"
//         $(".btns a").attr("href",target)
//         $(".bg-floue").fadeIn()
//     })
// })