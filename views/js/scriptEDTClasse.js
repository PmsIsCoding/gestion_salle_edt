$(function(){
    $(".addSeance").click(function(){
        let jour = $(this).attr("data-jour")
        let debut = $(this).attr("data-debut")
        let fin = $(this).attr("data-fin")
        let classe = $(this).attr("data-classe")

        $("#jour").attr("value",jour)
        $("#debut").attr("value",debut)
        $("#fin").attr("value",fin)
        $("#idClasse").attr("value",classe)
        
        $("#module").change(function(){
            var selectedOption = $(this).find('option:selected')
            var dataProf = selectedOption.data('prof')
            $(".modaleForm #professeur").attr("value", dataProf)
        })

        let xhr = new XMLHttpRequest()
        let target = "../modeles/getProfDispos.php?jour="+jour+"&debut="+debut+"h&fin="+fin+"h&classe="+classe
        xhr.open('GET',target)
        xhr.send()
        xhr.onreadystatechange = () =>{
            if(xhr.status == 200 && xhr.readyState == 4){
                if(xhr.responseText != ""){
                    $("#module").html(xhr.responseText)
                }

            }
        }
    })
})