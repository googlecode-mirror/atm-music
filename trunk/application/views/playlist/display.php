<?php echo render('partial.head'); ?>

<h4 class="titlePart" id="<?php echo $playlist->get_id_playlist() ?> "> <?php echo $playlist->get_name_playlist(); ?> </h4>
<table id="tableContent">
    <tr id="lineTitle">
        <th>
            Titre 
        </th>
        <th>
            Artiste 
        </th>
        <th>
            Album
        </th>
        <th>
            Durée
        </th>
        <th>
            
        </th>
        <th>
            
        </th>
        
        <th>
            
        </th>
        
    </tr>

    <?php foreach($songs as $value) { ?>
    <tr id="<?php echo $value->id_song ?>">
        <td >
            <?php echo $value->title_song ?>
        </td>
        <td >
            <?php echo $value->name_band ?>
        </td>
        <td >
            <?php echo $value->name_album ?>
        </td>
        <td >
            <?php echo $value->length_song ?>
        </td>
        <td class="playlist_remove">
            <button class="button_rm">Supprimer</button>
        </td>
         <td class="playlist_rm">
            Cette chanson va être rettirée. <button class="valider_rm">Continuer</button>
        </td>
           
       
        
    </tr>
    <?php } ?>
</table>
<br>
<?php echo render('partial.foot'); ?>
