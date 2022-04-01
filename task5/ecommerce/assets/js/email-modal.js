$(document).on('click','#update-email',function(event){
    event.preventDefault();
});

$('#save-cahnges').click(function(){
    $('#email-form').submit();
});