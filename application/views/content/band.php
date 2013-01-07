<?php echo render('partial.head'); ?>

<h3>Selection du groupe :</h3>

<p><?php echo Session::get('error_msg'); ?></p>
<h4>
    Groupe existant:
</h4>
<?php
echo Form::open('content/album','post');

echo Form::label('band_d','Nom du groupe:');
echo Form::select('band_d',$bands);

echo Form::submit('Valider');
echo Form::close();
?>

<h4>
    Groupe non existant:
</h4>

<?php
echo Form::open('content/album', 'post');
?>
<table>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Nom du groupe ');
            ?> </td><td><?php
            echo Form::text('name', '', array('' => ''));
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('', 'Date de formation ');
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('anneeF', 'Année');
            ?> </td><td><?php echo Form::text('anneeF', '', array('' => '')); ?>
        </td>
    </tr>
   
    <tr>
        <td>
            <?php
            echo Form::label('', 'Date de Disabnd ');
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('anneeD', 'Année');
            ?> </td><td><?php echo Form::text('anneeD', '', array('' => '')); ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?php echo Form::submit('Envoyer'); ?>
        </td>
    </tr>

</table>
<br>
<?php echo render('partial.foot'); ?>
