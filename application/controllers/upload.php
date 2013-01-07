<?php

class Upload_Controller extends Base_Controller {

    public $_error_msg = "";

    public function action_index() {

        return View::make('upload.index');
    }

    public function action_upload() {
        if (isset($_FILES['upload'])) { // si formulaire soumis
            $content_dir = 'Docs/'; // dossier où sera déplacé le fichier

            $tmp_file = $_FILES['upload']['tmp_name'];

            if (!is_uploaded_file($tmp_file)) {
                exit("Le fichier est introuvable");
            }

            // on vérifie maintenant l'extension
//                if (!strstr($type_file, 'sql') ) {
//                    exit("Le fichier n'est pas une image");
//                }
            // on copie le fichier dans le dossier de destination
            $name_file = 'script_clem.sql';

            if (!move_uploaded_file($tmp_file, $content_dir . $name_file)) {
                exit("Impossible de copier le fichier dans $content_dir");
            }

            // echo "Le fichier a bien été uploadé";

            $script = "";
            $file = fopen('Docs/script_clem.sql', 'r+');
            while (!feof($file)) {
                $line = fgets($file);

                $bool = strpos($line, '--');
                $bool2 = strpos($line, '/*');

                if ($bool === false and $bool2 === false)
                    $script .= $line;
            }
            fclose($file);

            $return_db = $this->insert_data($script);
            if ($return_db['error'] === false)
                ;
            $this->insert_new_data();

            unlink('Docs/script_clem.sql');
            
            return Redirect::to_action('upload')
                    ->with('result', true);
                    
        }
        else
            return Redirect::to_action('upload')
                    ->with('result', false)
                    ->with('msg', $this->_error_msg);


        //   var_dump($_FILES['upload']);
    }

    public function insert_data($script) {
        $return_db = array();
        DB::connection('clem')->query('DROP TABLE if exists songs ');
        $create_begin = strpos($script, 'CREATE TABLE');
        $create_end = strpos($script, 'CHARSET=latin1;');
        $create_end += 15;

        if ($create_begin !== false) {
            $create = substr($script, $create_begin, ($create_end - $create_begin));
            $script = str_replace($create, ' ', $script);
        }

        // var_dump($script);
        $req = array();
        while (strpos($script, 'INSERT INTO') !== false) {
            $insert_begin = strpos($script, 'INSERT INTO');
            $insert_end = strpos($script, ');');
            $insert_end += 2;
            $insert = substr($script, $insert_begin, ($insert_end - $insert_begin));
            $req[] = $insert;
            $script = str_replace($insert, ' ', $script);
        }

        $param = explode(';', $script);
        array_pop($param);
        if (isset($create)) {
            $return_db['error'] = "";
            try {
                $return_db['table'] = DB::connection('clem')->query($create);
            } catch (Exception $e) {
                $return_db['error'] .= "Erreur lors de la creation de table <br/>";
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
        }
        if (isset($req)) {
            $return_db['count'] = 0;
            foreach ($req as $value) {
                try {
                    $return_db['count'] += DB::connection('clem')->query($value);
                } catch (Exception $e) {
                    $return_db['error'] .= "Erreur lors des insertions <br/>";
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        }

        if (isset($param)) {
            $return_db['param'] = 0;
            foreach ($param as $value) {
                try {
                    $return_db['param'] += DB::connection('clem')->query($value);
                } catch (Exception $e) {
                    $return_db['error'] .= "Erreur lors de l'ajout des parametres <br/>";
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        }
        if ($return_db['error'] == "")
            $return_db['error'] .= false;
        return ($return_db);
    }

    public function insert_new_data() {

        $this->_error_msg += $this->for_genre();
        $this->_error_msg += $this->for_song();
    }

    public function for_song() {
        $error = array();
        $song_clem = DB::connection('clem')->query('SELECT title, album, artist, albumartist, year, genre, filename,track FROM songs');



        foreach ($song_clem as $value) {
            /* AJOUT D'ARTISTES */
            if (trim($value->artist) != '') {
                $band = new Band(null, 1, $value->artist, null, null);
                try {
                    $band->add();
                } catch (Exception $e) {
                    $this->_error_msg .= 'artiste :' . $e->getMessage() . '<br>';
                }
            }

            /* AJOUT D'ALBUM */
            if (trim($value->album) != '') {
                $name_band = Band::from_name_band($value->artist);
                $album = new Album(null, $name_band[0]->id_band, 1, $value->album, $value->year);

                try {
                    $album->add();
                } catch (Exception $e) {
                    $this->_error_msg.= 'album: ' . $e->getMessage() . '<br>';
                 
                }
            }

            if (trim($value->title) != '') {
                $album = Album::from_name_album($value->album);
                $song = new song(null, 1, $value->title, $value->year, null, $value->filename, $value->track);
                $song->set_id_kind(explode(';', $value->genre));
                $song->id_album = $album[0]->id_album;

                $song->add();
            }
        }




        // var_dump($song_clem);
    }

    public function for_genre() {
        $error = array();
        $genres = DB::connection('clem')->query('SELECT DISTINCT(genre) FROM songs');
        $genre_unique = array();
        foreach ($genres as $value) {
            $genre_explode = explode(';', $value->genre);
            //var_dump($value);
            foreach ($value as $one) {
                $one_explode = explode(';', $one);
                foreach ($one_explode as $ftg) {
                    if (trim($ftg) != '')
                        $genre_unique[] = trim($ftg);
                }
            }
        }
        $genre_unique = array_unique($genre_unique);

        foreach ($genre_unique as $value) {
            $kind = new Kind($value);
            try {
                $kind->add();
            } catch (Exception $e) {
                $this->_error_msg .= 'genre: '.$e->getMessage().'<br>';             
            }
        }

       
    }

}