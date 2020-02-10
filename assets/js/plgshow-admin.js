jQuery(document).ready(function($) {

    $( '#trash-buffer' ).click(function(){
        $('.trash-buffer-spinner').show();
        
        $.ajax({
            url: ajaxurl, 
            data: {
                'action': 'plgshow_trash_buffer',
            }, 
            success: function(response) {
                var defaultText = $('#trash-buffer').html();
                $('.trash-buffer-spinner').hide();
                $('#trash-buffer').removeClass('button-primary').attr("disabled", "disabled").html($('#trash-buffer').data('success'));
                setTimeout(function(){ 
                    $('#trash-buffer').addClass('button-primary').attr("disabled", false).html(defaultText);
                }, 3000);
            },
            error: function(response){
                $('.trash-buffer-spinner').hide();
                $('#trash-buffer').removeClass('button-primary').attr("disabled", "disabled").html($('#trash-buffer').data('error'));
            }
        }); 
    });
} );