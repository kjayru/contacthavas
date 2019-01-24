
$('#frm-contact').on('submit',function(e){
    e.preventDefault();
   
    let datasend = $("#frm-contact").serialize();

    $.ajax({
        url:'/proceso.php',
        type:'POST',
        dataType:'json',
        data: datasend,
        success(response){
            if(response.rpta=='ok'){
                window.location.href="/gracias.php";
            }
        }
    });
});