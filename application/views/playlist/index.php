<?php echo render('partial.head'); ?>
<div id="playlistDiv">
    <h3 class="titlePart"> Gestion des playlists </h3>

    
<a href="<?php echo URL::to_action('playlist@add') ?>" ><button class="buttonAdd">Ajouter une playlist</button></a>

    <h4> Mes playlists :</h4>

    <?php
    foreach ($playlist as $value) {
        if ($value->code_admin == "A") {
            ?>
            <table>
                <tr class="<?php echo $value->id_playlist ?>">
                    <td>
                        <button class="before_delete">x</button>
                        <button class="delete_playlist">Supprimer cette playlist ?</button>
                    </td>
                    <td>
                           <a class="name_playlist" href=""><?php echo $value->name_playlist . '  (' . $value->date_creation_playlist . ')'; ?></a>

                    </td>

                    <td>
                        <ul>

                        </ul> Ajouter un administrateur :
                        <?php echo Form::text('username', 'nom d\'utilisateur', array('class' => 'user_field')); ?>
                    </td>
                    <td>

                        <button class="user_submit">Ajouter</button>
                    </td>
                    <td class="user_validation">

                    </td>
                </tr>

            </table>
            <table class="invited <?php echo $value->id_playlist?>">

                <?php foreach ($value->admins as $one) { ?>
                    <tr class="<?php echo $one->id_user_lif ?>">
                        <td>
                            <?php echo $one->username_user_lif ?> 

                        </td>
                        <td>
                            <button class="user_delete"> </button>
                        </td>
                        <td class="delete_validation">
                            
                        </td>
                    </tr>

                <?php } ?>
            </table>



            <?php
        }
    }
    ?>
    <h4> Playlist où je suis invité: </h4>
    <?php
    foreach ($playlist as $value) {
        if ($value->code_admin == "I") {
            ?>

            <ul>
                <?php echo $value->name_playlist . '  (' . $value->date_creation_playlist . ')'; ?>
            </ul>
            <?php
        }
    }
    ?>
</div>
<br>
<?php echo render('partial.foot'); ?>
