<?php echo render('partial.head'); ?>

<?php
$msg = Session::get('error');
$form['name'] = "";
$form['anneeF'] = "";
if(isset($msg))
{
    echo Session::get('error_msg');
    $form = Session::get('form');
}

echo Form::open('album/add_album', 'post');
?>

<h3 class="titlePart">Ajout d'album</h3>
<div id="divForm">
<table>
    <tr>
        <td>
            <?php
            echo Form::label('band', '* Nom du groupe ');
            ?> </td>
    </tr>
    <tr><td><?php
            echo Form::select('band', $band);
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Nom de l\'album ');
            ?> </td>
    </tr>
    <tr><td><?php
            echo Form::text('name', $form['name'], array('' => ''));
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            /*echo Form::label('', 'Date de production ');*/
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('anneeF', 'Année de production');
            ?> </td>
    </tr>
    <tr><td><?php echo Form::text('anneeF', $form['anneeF'], array('' => '')); ?>
        </td>
    </tr>
   
    
        <td>
            <?php echo Form::submit('Envoyer'); ?>
        </td>
    </tr>

</table>
</div>

<br>



<?php echo render('partial.foot'); ?>