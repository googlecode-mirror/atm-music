<?php echo render('partial.head'); ?>

<h3> Ajouter une chanson : </h3>

<?php
echo Form::open('content/final', 'post');
?>
<table>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Titre de la chanson ');
            ?> </td><td><?php
            echo Form::text('name', '', array('' => ''));
            ?>

        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('', 'Date de sortie ');
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
            echo Form::label('Genre', 'Genre');
            ?> </td><td><?php
            foreach ($kinds as $kind) {
                echo Form::label('Rap', $kind->attributes['name_kind']);
                echo Form::checkbox('genre[]', $kind->attributes['name_kind']);
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
<?php
echo Form::label('path', 'Fichier');
?> </td><td><?php
echo Form::file('path');
?>
        </td>
    </tr>

    <tr>
        <td>
<?php
echo Form::label('length', 'Durée');
?> </td><td><?php
echo Form::select('lengthM', array('0' => '0',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4'));
?>
            <?php
            ?> <?php
            echo Form::select('lengthS', array('00' => '00',
                '10' => '10',
                '20' => '20',
                '30' => '30',
                '40' => '40',
                '50' => '50'));
            ?>
        </td>
    </tr>


    <tr>
        <td>
<?php
echo Form::label('num', 'Numéro dans l\'album');
?> </td><td><?php echo Form::text('num', '', array('' => '')); ?>
        </td>
    </tr>

    <tr>
        <td>
<?php echo Form::submit('Envoyer'); ?>
        </td>
    </tr>

</table>





<?php
echo Form::close();
?>

<br>
<?php echo render('partial.foot'); ?>
