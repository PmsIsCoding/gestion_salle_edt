$(function(){
    $(".emploi").click(function(){
        let jour = $(this).attr("data-jour")
        let debut = $(this).attr("data-debut")
        let fin = $(this).attr("data-fin")
        let seance = $(this).attr("data-seance")
        $("#seance").val(seance)

        let xhr = new XMLHttpRequest()
        let target = `../modeles/getSallesDispos.php?jour=${jour}&debut=${debut}&fin=${fin}`

        xhr.open("GET",target)
        xhr.send()
        xhr.onreadystatechange = function(){
            if(xhr.status == 200 && xhr.readyState == 4)
                $("#selectSalle").html(xhr.responseText)
        }
    })
})