<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>At The Moment - Music</title>
        <meta name="viewport" content="width=device-width">
        <link rel="icon" type="image/png" href="../img/icone.png" />
        <?php echo HTML::style('/css/font.css') ?>
        <?php echo HTML::style('/css/head.css') ?>
        <?php echo HTML::style('/css/content.css') ?>
        <?php echo HTML::style('/css/foot.css') ?>
        <?php echo HTML::script('/js/jQuery.js') ?>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <?php echo HTML::script('/js/someJquery.js') ?>
        <?php echo HTML::script('/js/hc/highcharts.js') ?>

    </head>
    <body>
        <?php
        $user = Session::get('user');
        $playlist = Session::get('playlist');
        ?>
        <div id="blanket"></div>
  
        <div id="header">
            <div id="nav">
                <?php
                echo Form::open('search', 'post');
                echo Form::text('toSeek', 'Rechercher', array('id' => 'toSeek'));
                echo Form::button('Go', array('id' => 'loupe'));
                echo Form::close();
                ?>




                <h3>
                    <?php if (!isset($user)) {
                        ?>
                        <a href="<?php echo URL::to_action('signin@index') ?>" > Enregistrement </a> |
                        <a href="<?php echo URL::to_action('login@index') ?>" > Connexion </a>
<?php } else { ?>
                        <ul class="navigation">

                            <li><a href="#">Playlist </a>
                                <ul>
                                    <?php
                                    if (isset($playlist))
                                        ;
                                    foreach ($playlist as $value) {
                                        ?>
                                        <li><a href="<?php echo URL::to_action('playlist@display', array($value->id_playlist)) ?>"><?php echo $value->name_playlist ?></a></li>
        <?php
    }
    ?>
                                    <li><a href="<?php echo URL::to_action('playlist') ?>">Administration</a></li>



                                </ul>
                                <div class="clear"></div>
                            </li>
                            <li><a href="#">Outils </a>
                                <ul>
                                
                                    <li><a href="<?php echo URL::to_action('info') ?>">A Propos</a></li>
                                    <li><a href="<?php echo URL::to_action('Stats') ?>">Statistiques</a></li>
                                    <li><a href="<?php echo URL::to_action('band') ?>">Groupes</a></li>
                                    <li><a href="<?php echo URL::to_action('album') ?>">Albums</a></li>
                                    <li><a href="<?php echo URL::to_action('song') ?>">Chansons</a></li>
                                    <li><a href="<?php echo URL::to_action('upload') ?>">Importer</a></li>
                                </ul>
                                <div class="clear"></div>
                            </li>
                            <li> <a href="#"><?php echo $user->get_username_user_lif(); ?> </a> 
                                <ul>
                                    <li><a href="">Mon profil</a></li>
                                    <li><a href="<?php echo URL::to_action('login@logout') ?>">Se déconnecter</a></li>
                                </ul>
                        </ul>



                    </h3>


<?php } ?>


            </div>
        </div>
        <div id="content">

