<?php echo render('partial.head'); ?>
<table id="addContentTable">
    <tr>
        <td><strong>Ajout de contenu</strong></td>
    </tr>
    <tr>
        <td>
            <a href="<?php echo URL::to_action('band@index') ?>" > <div class="addContentButton">Ajouter un groupe</div></a> 
        </td>
        <td>
            <a href="<?php echo URL::to_action('album@index') ?>" > <div class="addContentButton">Ajouter un album</div></a>
        </td>
        <td>
            <a href="<?php echo URL::to_action('song') ?>" > <div class="addContentButton">Ajouter une chanson</div></a> 
        </td>
    </tr> 
</table>
<?php echo render('partial.foot'); ?>