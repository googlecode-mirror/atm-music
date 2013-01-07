<?php echo render('partial.head'); ?>
<?php
$msg = Session::get('error');
$form['name'] = "";
$form['anneeF'] = "";
$form['anneeD'] = "";
if(isset($msg))
{
    echo Session::get('error_msg');
    $form = Session::get('form');
}

echo Form::open('band/add_band', 'post');
?>
<h3 class="titlePart">Ajout de groupe</h3>
<div id="divForm">
<table>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Nom du groupe ');
            ?> </td>
    </tr>
    <tr>
        <td><?php
            echo Form::text('name', $form['name'], array('' => ''));
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            /*echo Form::label('', 'Date de formation ');*/
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('anneeF', 'Année de formation');
            ?> </td>
    </tr>
    <tr><td><?php echo Form::text('anneeF', $form['anneeF'], array('' => '')); ?>
        </td>
    </tr>
   
    <tr>
        <td>
            <?php
            /*echo Form::label('', 'Date de Disabnd ');*/
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('anneeD', 'Année de disband');
            ?> </td>
    </tr>
    <tr><td><?php echo Form::text('anneeD', $form['anneeD'], array('' => '')); ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?php echo Form::submit('Ajouter le groupe'); ?>
        </td>
    </tr>

</table>
</div>
<br>
<?php echo render('partial.foot'); ?>