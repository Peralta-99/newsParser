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
    const lazyLoadOfArticles = !!$('#lazy_load').prop('checked');
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
                if (data.jsonFileName) {
                    window.location = `/getScrapedArticles/${data.jsonFileName}`;
                } else {
                    alert('Ошибка');
                }
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
