$(function () {
    
    $('body').on('change', '#current_site', function( ) { 
    
        var $data = $(this).serialize('input,select');
        
        console.log( $data );
    
        $.ajax({
            type:"get",
            url: "/admin/bcsitemanager/sitemanagers/updatecurrentsite",
            data: $data,
            dataType: 'html',
            success: function ( msg ) {
                $('.alert-wrapper').html(msg);
            },
            error: function ( msg ) {
                $('.alert-wrapper').html(msg);
            }
          }).done(function( msg ) {
            
            
            
            
          
          });
    
                    
            
    });
    
    
    $('body').on('click', '.alert-close', function() {
              
              //alert('test');
              $('[data-alert]').hide();
              
          });
    
    
});
