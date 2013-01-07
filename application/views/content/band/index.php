<?php echo render('partial.head'); ?>
<?php

?>
<h3 class="titlePart">Groupes</h3>
<a href="<?php echo URL::to_action('band/add') ?>" ><button class="buttonAdd"> Ajouter un nouveau groupe </button></a>

<table id="tableContent">
    <tr id="lineTitle">
        <th>
            Nom du groupe
        </th>
        <th>
            Date de formation
        </th>
    </tr>
    <?php foreach ($band as $value) { ?>
    <tr>
        <td>
           <?php echo $value->name_band?>
        </td>
        
         <td>
            <?php echo $value->date_form_band?>
        </td>
    </tr>
    
    <?php    
 }?>
</table>
<br>
<?php echo render('partial.foot'); ?>