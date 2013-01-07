<?php echo render('partial.head'); ?>

   <p id="errorMessage"> <?php echo Session::get('error_msg'); ?> </p>

<div id="divForm">
<strong>Connexion</strong>
<?php
   if(isset($logged))
       echo "Vous êtes déjà connecté, veuillez vous deconecter pour accéder à cette interface.";
   else
   {
    ?> <table>
        <tr>
            <td><?php
            echo Form::open('login/log', 'post');
            echo Form::label('user', 'Nom d\'utilisateur'); ?> 
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
            echo Form::label('pw', 'Mot de passe');?> 
            </td>
        </tr>
        <tr>
            <td> <?php
            echo Form::password('pw',array(''=>''));
            ?>
            </td>
        </tr>
        <tr>
            <td>  <?php
            echo Form::submit('Connexion');
            echo Form::close();
            ?>
            </td>
        </tr>
    </table>
<?php } ?>
  
</div>

<br>
<?php echo render('partial.foot'); ?>
