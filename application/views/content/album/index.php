<?php echo render('partial.head'); ?>



<?php

?>
<h3 class="titlePart">Albums</h3>
<a href="<?php echo URL::to_action('album/add') ?>" ><button class="buttonAdd"> Ajouter un nouvel album </button></a>

<table id="tableContent">
    <tr id="lineTitle">
        <th>
            Groupe
        </th>
        <th>
            Nom de l'album
        </th>
        <th>
            Date de production
        </th>
        
    </tr>
    <?php foreach ($album as $value) { ?>
    <tr>
        <td>
           <?php echo $value->attributes['name_band'] ?>
        </td>
        <td>
           <?php echo $value->name_album ?>
        </td>
        
         <td>
            <?php echo $value->date_prod_album ?>
        </td>
    </tr>
    
    <?php    
 }?>
</table>
<br>
<?php echo render('partial.foot'); ?>