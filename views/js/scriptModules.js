$(function(){
    $(".plus").click(function(){
        let module = $(this).data("module")
        let xhr = new XMLHttpRequest()
        let button = $(this);
        xhr.open("GET","../modeles/vHoraire.php?option=plus&module="+module)
        xhr.send()
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200)
                button.siblings(".vfait").text(xhr.responseText)
        }
    })
    $(".moins").click(function(){
        let module = $(this).data("module")
        let xhr = new XMLHttpRequest()
        let button = $(this);
        xhr.open("GET","../modeles/vHoraire.php?option=moins&module="+module)
        xhr.send()
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200)
                button.siblings(".vfait").text(xhr.responseText)
        }
    })
})