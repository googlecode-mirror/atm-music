$(document).ready(function() {
    
    $('#blanket').hide();

    $(".display_pl").hide();
    $(".playlist_rm").hide();
    $(".message_success").hide();
    $(".message_fail").hide();
    $('#toSeek').click(function(){
        $('#toSeek').val('');
    });
    /****************************/
    $(".button_pl").click(function(){
        clear_button();
        var id = $(this).closest('tr').attr('id');
        $("tr#"+id+" .display_pl").fadeIn();
        $("tr#"+id+" .button_pl").hide();
    });
  
  
    $('ul.display_pl li a').click(function(event){
        event.preventDefault();
        var id = $(this).closest('tr').attr('id');
        add_song_to_playlist(id, $(this).attr('class'));
    });
    
    
   

    /*********************************/
    $(".button_rm").click(function(){
        clear_button();
        var id = $(this).closest('tr').attr('id');
        $("tr#"+id+" .playlist_rm").fadeIn();
        $("tr#"+id+" .button_rm").hide();
    });
  
  
    $('.valider_rm').click(function(){   
        var id = $(this).closest('tr').attr('id');
        remove_song_to_playlist(id, $('h4').attr('id'));
    });
    
    $(".user_submit").click(function(){
        var id = $(this).closest('tr').attr('class');
        var username = $('tr.'+id+' input').attr('value');
        add_user_to_playlist(id, username);
        
    });
    // hover property will help us set the events for mouse enter and mouse leave
    $('.navigation li').hover(
        // When mouse enters the .navigation element
        function () {
            //Fade in the navigation submenu
            $('ul', this).stop().fadeIn(); // fadeIn will show the sub cat menu
        },
        // When mouse leaves the .navigation element
        function () {
            //Fade out the navigation submenu
            $('ul', this).stop().fadeOut(); // fadeOut will hide the sub cat menu
        }
        );
            
    $(".invited").hide();
    $(".name_playlist").click(function(e){
        e.preventDefault(e);
        var id = $(this).closest('tr').attr('class');
        if($('.invited.'+id).is(':hidden'))
        {
            $('.invited.'+id).show();
        }
        else
        {
            $('.invited.'+id).hide();
        }
    })

    $('.user_delete').click(function(){
        var id_user = $(this).closest('tr').attr('class');
        var id_playlist = $(this).closest('table').attr('class').replace('invited ','');
        remove_user_from_playlist(id_user,id_playlist);
    })
    
    $('.delete_playlist').hide();
    $('.before_delete').click(function(){
        var id = $(this).closest('tr').attr('class');
        $('tr.'+id+' .before_delete').fadeOut(function(){
           clear_button_delete();
            $('tr.'+id+' .delete_playlist').fadeIn();
        });
    });
    
    $('.delete_playlist').click(function(){
        var id = $(this).closest('tr').attr('class');
        delete_playlist(id);
    });
    $('ul.display_pl').draggable();
});


function clear_button()
{
    $(".button_pl").show();
    $(".display_pl").hide();
   
    $(".button_rm").show();
    $(".playlist_rm").hide();
}
function clear_button_delete()
{
    $(".delete_playlist").hide();
    $('.before_delete').fadeIn();
   
}
  
function add_song_to_playlist(id_song,id_playlist)
{
    $.ajax({
        url: "search/add_song_to_playlist",
        type: "POST",
        data: {
            id_song : id_song,
            id_playlist : id_playlist
        },
        dataType: "html",
        success: function(data) {
         
         
            clear_button();
            $("tr#"+id_song+" .message_success").fadeIn().delay(3000).fadeOut();
        }
    });   
}


function remove_song_to_playlist(id_song,id_playlist)
{
    $.ajax({
        url: "../remove_song_to_playlist",
        type: "POST",
        data: {
            id_song : id_song,
            id_playlist : id_playlist
        },
        dataType: "html",
        success: function(data) {       
            clear_button();
            $("tr#"+id_song).fadeOut();
        }
    });   
}

function add_user_to_playlist(id_playlist,username)
{
    $.ajax({
        url: "playlist/add_user_to_playlist",
        type: "POST",
        data: {
            username : username,
            id_playlist : id_playlist
        },
        dataType: "html",
        success: function(data) {
            switch(data){
                case '1':
                    $('tr.'+id_playlist+' .user_validation').html('Utilisateur ajouté avec succés');
                    break;
                case '0':
                    $('tr.'+id_playlist+' .user_validation').html('Utilisateur ajouté avec succés');
                    break;
                case '-1':
                    $('tr.'+id_playlist+' .user_validation').html('Cet utilisateur est déjà invité');
                    break;
                case '-2':
                    $('tr.'+id_playlist+' .user_validation').html('Utilisateur introuvable');
                    break;
                    
            }
        }
    });   
}
function remove_user_from_playlist(id_user,id_playlist)
{
    $.ajax({
        url: "playlist/remove_user_from_playlist",
        type: "POST",
        data: {
            id_user : id_user,
            id_playlist : id_playlist
        },
        dataType: "html",
        success: function(data) {
        
            switch(data){
                case '1':
                    $('.invited tr.'+id_user).delay(4111).hide();
                    break;
                case '0':
                    $('tr.'+id_user+' .delete_validation').html('Une erreur est survenue');
                    break;
                case '-1':
                    $('tr.'+id_user+' .delete_validation').html('Une erreur estsurvenue');
                    break;
      
            }
        }
    });   
}
    function delete_playlist(id)
    {
        $.ajax({
            url: "playlist/delete_playlist",
            type: "POST",
            data: {
                id : id           
            },
            dataType: "html",
            success: function(data) {
                
                $('table tr.'+id).hide();
            }
        });   
    
}
