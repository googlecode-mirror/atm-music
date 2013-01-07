<?php echo render('partial.head'); ?>
<?php

?>
<h3> <?php echo $count ?> résultats de la recherche pour "<?php echo $toSeek ?>" </h3>


<h4 class="titlePart2"> Chansons </h4>
<table class="toSeek_result" id="tableContent">
    <tr id="lineTitle">
        <th class="toSeek_title">
            Titre 
        </th>
        <th class="toSeek_band">
            Artiste 
        </th>
        <th class="toSeek_album">
            Album
        </th>
        <th class="toSeek_length">
            Genre
        </th>
        <th class="toSeek_add">
            Ajouter
        </th>
        <th class="toSeek_msg">
            
        </th>
        
    </tr>

    <?php foreach($song as $value) { ?>
    <tr id="<?php echo $value->id_song ?>">
        <td class="toSeek_title">
            <?php echo $value->title_song ?>
        </td>
        <td class="toSeek_band">
            <?php echo $value->name_band ?>
        </td>
        <td class="toSeek_album">
            <?php echo $value->name_album ?>
        </td>
        <td class="toSeek_length">
            <?php echo $value->name_kind ?>
        </td>
        <td class="playlist">
            <button class="button_pl">Ajouter à :</button>
           
             <ul class="display_pl">
                <?php foreach($playlist as $value) { ?>
                <li>
                    <a class ="<?php echo $value->id_playlist ?>" href=""> <?php echo $value->name_playlist?> </a>
                </li> <?php } ?>
                
                
            </ul>
            <div class="message_fail"> Une erreur est survenue, veuillez ressayer </div>
            <div class="message_success"> Chanson ajoutée avec succes !</div>
        </td>
        
    </tr>
    <?php } ?>
</table>
<br>
<?php echo render('partial.foot');