$(document).on('click', '.testJs', function() {
    console.log('Card clicada!');
    var Idreceita = $(this).data('user-id');
    console.log(Idreceita);
});
