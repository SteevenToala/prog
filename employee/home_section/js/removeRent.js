$(document).on('click','.eliminar',function(e){
    const idRent = $(this).data('id'); 

    let formData = new FormData();
    formData.append('rent_id',idRent);
    fetch('./home_section/scripts/removeRent.php',{
        method:'POST',
        body:formData
    })
    .then(response =>response.text())
    .then(data=>{
        const alerta = $('#alerta2');
        if(data.includes('exitoso')){
            alerta.removeClass('d-none alert-danger').addClass('alert-success').text('¡Alquiler eliminado exitosamente!');
            $(this).closest('tr').remove();
        }else{
            alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: '+data);
        }
    })
    .catch(error=>{
        console.error('Error:',error);
    });

});