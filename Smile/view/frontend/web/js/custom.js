require(['jquery'],function($){
    $(document).ready(function(){
        $('.edit_rss_link').click(function(){
            
        });
        
        
        // add news link
        $('.add-news-link').click(function(){
            $('.add_news_form').removeClass('toggle-class-default');
        });
        
        // delete news
        $('.delete_rss_link').click(function(){
            var customurl = BASE_URL+"helloworld/index";
            $.ajax({
                url: customurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    news_id: $(this).data('news-id'),
                    action: 'delete_news',
                },
            complete: function(response) {
                    $('.news-row-'+response.responseJSON.news_id).remove();
                },
                error: function (xhr, status, errorThrown) {
                    console.log('Error happens. Try again.');
                }
            });
        });
        
    });
});
