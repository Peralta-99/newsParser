$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$('#submitAjaxForm').click(function() {
    const siteUrl = $('#url').val();
    const articleSelector = $('#selector').val();
    const countOfArticles = $('#count').val();
    const lazyLoadOfArticles = !!$('#lazy_load').val();
    if (siteUrl && articleSelector && countOfArticles) {
        loading(true);
        $.ajax({
            type: 'POST',
            url: '/getArticles',
            data: {
                siteUrl,
                articleSelector,
                countOfArticles,
                lazyLoadOfArticles,
            },
            dataType: 'json',
            async: true,
            beforeSend: function(){
                loading(true);
            },
            complete: function(){
                loading(false);
            },
            success: function(data){

            }
        });
    } else return;
});

// Loader
function loading(show){
    if(show){
        $('#loader').show();
    }else{
        $('#loader').hide();
    }
}
