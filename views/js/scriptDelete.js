$(function(){
    $(".delete").click(function(){
        let target = "../modeles/delete.php?id="+$(this).attr("data-id")+"&option="+$(this).attr("data-option")
        $(".btns a").attr("href",target)
    })
})