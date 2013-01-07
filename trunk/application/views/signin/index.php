<?php echo render('partial.head'); ?>

<div id="divForm">
    <strong>Créer un compte</strong>
<?php
   echo Session::get('error_msg');
?> 
<table>
   <tr>
        <td>
        <?php
        echo Form::open('signin/add_user', 'post');

        echo Form::label('user', '* Nom d\'utilisateur'); ?> 
        </td>
   </tr>
   <tr>
        <td> <?php
        echo Form::text('user','',array(''=>''));
        ?>
        </td>
   </tr>
   <tr>
       <td> <?php
        echo Form::label('pw', '* Mot de passe');?> 
       </td>
   </tr>
   <tr>
       <td> <?php
         echo Form::password('pw',array(''=>''));
        ?>
       </td>
   </tr>
   <tr>
       <td> <?php
        echo Form::label('name', '* Nom de famille');?> 
       </td>
   </tr>
   <tr>
       <td>
        <?php
        echo Form::text('name','',array(''=>''));
        ?>
       </td>
   </tr>
   <tr>
       <td> <?php
        echo Form::label('fname', '* Prénom');?> 
       </td>
   </tr>
   <tr>
       <td> 
        <?php
        echo Form::text('fname','',array(''=>''));
        ?>
        </td>
   </tr>
   <tr>
       <td> <?php
        echo Form::submit('Créer le compte');
        echo Form::close();
        ?>
       </td>
   </tr>
</table>
    <p>Les champs avec une * sont obligatoires. </p>
  
</div>
<br>
<?php echo render('partial.foot'); ?>
