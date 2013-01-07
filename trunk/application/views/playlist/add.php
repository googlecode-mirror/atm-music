<?php echo render('partial.head'); ?>
<h3> Ajouter une playlist </h3>
<?php
//$msg = Session::get('error');
$form['playlist'] = "";

//if(isset($msg))
//{
//    echo Session::get('error_msg');
//    $form = Session::get('form');
//}

echo Form::open('playlist/add_playlist', 'post');
?>


<table>
    <tr>
        <td>
            <?php
            echo Form::label('playlist', '* Nom de votre playlist ');
            ?> </td><td><?php
            echo Form::text('playlist', $form['playlist'], array(''=>''));
            ?>

        </td>
    </tr>
     <tr>
        <td>
            <?php
            echo Form::submit('valider');
            ?>

        </td>
    </tr>
   
</table>



<br>

<?php echo render('partial.foot'); ?>