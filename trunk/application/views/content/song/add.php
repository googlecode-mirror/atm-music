<?php echo render('partial.head'); ?>
<?php
$msg = Session::get('error');
$form['name'] = "";
$form['album'] = null;
$form['anneeF'] = "";
$form['lengthM'] = "";
$form['lengthS'] = "";
$form['num'] = "";
?>

    <h3 class="titlePart">Ajout de chanson</h3>
<?php
if($album == null)
{
    ?><p id="errorMessageSong"> Le groupe choisi n'a pas d'album </p> <?php
}
if (isset($msg)) {
    echo Session::get('error_msg');
    $form = Session::get('form');
    //var_dump($form);
}
?>
<div id="divFormSong">
<?php
echo Form::open('song/add', 'post');
?>  
<table>
    <tr>
        <td>
            <?php
            echo Form::label('band', 'Nom du groupe ');
            ?> 
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::select('band', $band, $band_selected);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::submit('Accéder aux albums');
            echo Form::close();
            ?>
        </td>
    </tr>
</table>

<?php echo Form::open('song/add_song', 'post');
echo Form::hidden('id_group', $band_selected, array('' => ''));
?>
<?php if (isset($album)) {
    ?>
    <table>
        <tr>
            <td>
                <?php
                echo Form::label('album', 'Nom de l\'album ');
                ?> </td>
    </tr>
    <tr>
        <td><?php
            echo Form::select('album', $album, $form['album']);
            ?>
        </td>
        </tr>
   </table>
<?php } ?>

<?php ?>
<table>
    <tr>
        <td>
            <?php
            echo Form::label('name', '* Titre de la chanson ');
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
            echo Form::label('anneeF', 'Année');
            ?> </td>
    </tr>
    <tr><td><?php echo Form::text('anneeF', $form['anneeF'], array('' => '')); ?>
        </td>
    </tr>

    <tr>
        <td>
            <?php
            echo Form::label('Genre', 'Genre');
            ?> </td>
    </tr>
    <tr><td>
        <table><tr><?php
    $cpt = 0;
            foreach ($kinds as $kind) { $cpt++;
                echo '<td>';
                echo Form::checkbox('genre[]', $kind->attributes['name_kind']);
                echo Form::label('Rap', $kind->attributes['name_kind']);
                echo '</td>';
            
                if($cpt%3==0) echo '</tr><tr>';
                
            }
            ?>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo Form::label('path', 'Fichier');
            ?> </td>
    </tr>
    <tr><td><?php
            echo Form::file('path');
            ?>
        </td>
    </tr>

    <tr>
        <td>
            <?php
            echo Form::label('length', 'Durée');
            ?> </td>
    </tr>
    <tr id="ligneDuree"><td><?php
            echo Form::select('lengthM', array('0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4'), $form['lengthM']); echo ' min ';
            ?><?php
            echo Form::select('lengthS', array('00' => '00',
                '10' => '10',
                '20' => '20',
                '30' => '30',
                '40' => '40',
                '50' => '50'), $form['lengthS']); echo ' sec';
            ?>
        </td>
    </tr>


    <tr>
        <td>
            <?php
            echo Form::label('num', 'Numéro dans l\'album');
            ?> </td>
    </tr>
    <tr><td><?php echo Form::text('num', $form['num'], array('' => '')); ?>
        </td>
    </tr>

    <tr>
        <td>
            <?php
            if (isset($album))
                echo Form::submit('Envoyer');
            else
                echo Form::submit('Envoyer', array('disabled' => 'disabled'));
            echo Form::close();
            ?>
        </td>
    </tr>

</table>





<?php
echo Form::close();
?>
</div>

<br>
<?php echo render('partial.foot'); ?>