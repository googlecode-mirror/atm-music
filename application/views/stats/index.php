<?php echo render('partial.head'); ?>
<?php echo HTML::script('/js/chart.js') ?>
<?php ?><br><br>

    <table id="stats_partTable">
        
    <th class="titlePart">Quelques chiffres</th>
     <th class="titlePart">Graphiques </th>

    <tr>
        <td>
        Nombre total de groupes référencés : <?php echo $band_count ?>
        </td>
        <td><a id="song_graph" href="#"> Repartition des chansons par genre </a></td>
    </tr>

    <tr>
        <td>
        Nombre total d'albums référencés : <?php echo $album_count ?>
        </td>
        <td><a id="album_graph" href="#"> Repartition des albums par genre </a></td>
    </tr>

    <tr>
        <td>
        Nombre total de chansons référencées : <?php echo $song_count ?>
        </td> 
        <td><a id="band_graph" href="#"> Repartition des groupes par genre </a></td>
    </tr>
    
    <tr>
        <td>
        Année la plus productive : <?php echo $best_year_song[0]->date_song . '(' . $best_year_song[0]->count . ' chansons)' ?>
        </td>
        <td><a id="by_date_graph" href="#"> Repartition des albums et chansons par date </a></td>
    </tr>
    
    <tr>
        <td>
        Nombre total de playlist : <?php echo $playlist_count ?>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>
        Chansons les plus appréciées : <br/> 
        <ul id="listSongLike">
        <?php
        foreach ($max_in_playlist as $value) {
            echo '<li>';
            echo $value->title_song . ' - ' . $value->name_band . '<br/>';
            echo '</li>';
        }
            ?>
        </ul>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>
        Nombre total d'utilisateurs : <?php echo $user_count ?>
        </td>
        <td></td>
    </tr>

    <div id="popup">
        <div id="pie_chart"></div>
        <div id="bar_chart"></div>  
    </div>
</table>

<br>
<?php  echo render('partial.foot');