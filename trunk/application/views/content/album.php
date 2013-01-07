<?php echo render('partial.head'); ?>

<h3>Selection de l'album :</h3>
<p><?php echo Session::get('error_msg'); ?></p>
<h4>
    <?php if($albums != null) { ?>
    Album existant:
</h4>
<?php
echo Form::open('content/song','post');

echo Form::label('album_d','Nom de l\'album:');
echo Form::select('album_d',$albums);

echo Form::submit('Valider');
echo Form::close();
    }
?>

<h4>
    Album non existant:
</h4>

<?php

echo Form::open('content/song', 'post');
?>
<table>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Nom de l\'album ');
            ?> </td><td><?php
            echo Form::text('name', '', array('' => ''));
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('', 'Date de production ');
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
            <?php echo Form::submit('Envoyer'); ?>
        </td>
    </tr>

</table>
<br>
<?php echo render('partial.foot'); ?>
