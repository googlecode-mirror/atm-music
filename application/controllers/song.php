<?php

class Song_Controller extends Base_Controller {

    private $_error_msg = "";
    private $_error_form = false;

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_std = Song::from_id($user->get_id_user_lif());
            $song = array();
            $playlist = adminPlaylist::get_completed($user->get_id_user_lif());
            foreach ($song_std as $value) {
                $one = new Song($value->id_song, $value->id_user_lif, $value->title_song, $value->date_song, $value->length_song, $value->path_song, $value->track_song);
                $one->complete();
                array_push($song, $one);
            }
            
            return View::make('content.song.index')
                            ->with('playlist', $playlist)
                            ->with('song', $song);
        }
    }

    public function action_add() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $kind = Kind::all();
            $form = Session::get('form');
            $band_selected = null;
            $id_band = null;


            if (isset($_POST['band']))
                $band_selected = $_POST['band'];
            if (isset($form['id_group']))
                $band_selected = $form['id_group'];
            if (isset($_POST['id_group']))
                $band_selected = $_POST['id_group'];


            if (isset($form))
                $album_selected = $form['album'];
            else
                $album_selected = null;

            if (isset($band_selected)) {
                $album = Album::get_from_id($band_selected);
                if (count($album) != 0) {
                    $album_for_select = array();
                    foreach ($album as $value) {
                        $album_for_select[$value->id_album] = $value->name_album;
                    }
                    if (isset($_POST['id_band']))
                        $band_selected = $_POST['band'];
                    if (isset($_POST['band']))
                        $band_selected = $_POST['band'];
                }
                else {
                    $album_for_select = null;
                    $this->_error_msg = "Ce groupe n'a pas d'album, veuillez l'ajouter! </br>";
                }
            }
            else
                $album_for_select = null;
            $band = Band::all();
            $band_for_select = array();
            foreach ($band as $value) {
                $band_for_select[$value->attributes['id_band']] = $value->attributes['name_band'];
            }
            return View::make('content.song.add')
                            ->with('band', $band_for_select)
                            ->with('band_selected', $band_selected)
                            ->with('album_selected', $album_selected)
                            ->with('album', $album_for_select)
                            ->with('msg', $this->_error_msg)
                            ->with('kinds', $kind);
        }
    }

    public function action_add_song() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song = new Song();
            $form = $_POST;

            $song->set_id_kind(null);

            if ($_POST['name'] != "")
                $song->set_title_song($_POST['name']);
            else {
                $this->_error_form = true;
                $this->_error_msg .= "Il y a une erreur dans le titre. </br>";
            }

            if (isset($_POST['genre']))
                $song->set_id_kind($_POST['genre']);
            else {
                $this->_error_form = true;
                $this->_error_msg .= "Il faut sélectionner au moins 1 genre. </br>";
            }

            if (is_numeric($_POST['anneeF']) and preg_match("/^[0-2][0-9]{3}+$/", $_POST['anneeF']) == 1)
                $song->set_date_song($_POST['anneeF']);
            else {
                $this->_error_form = true;
                $this->_error_msg .= "Le format de l'année n'est pas valable. (Format:AAAA). </br>";
            }


            if (is_numeric($_POST['num']))
                $song->set_track_song($_POST['num']);
            else {
                $this->_error_form = true;
                $this->_error_msg .= "Le numéro dans l'album doit être numérique. </br>";
            }

            if (isset($_POST['path'])) {
                $path = str_replace(' ', '_', $_POST['path']);
                $song->set_path_song(str_replace('public', '', URL::base()) . 'song/' . $path);
            } else {
                $this->_error_form = true;
                $this->_error_msg .= "Vous devez rentrez un fichier dans le formulaire de téléversement. </br>";
            }
            if ($this->_error_form == false) {
                $song->set_length_song($_POST['lengthM'], $_POST['lengthS']);
            }
            //var_dump(isset($_POST['album']));
            if (isset($_POST['album'])) {
                $song->_id_album = $_POST['album'];
            } else {
                $this->_error_form = true;
                $this->_error_msg .= "Ce groupe n'a pas encore d'album, veuillez le créer. </br>";
            }



            if ($this->_error_form == false and !$song->check_exists()) {
                $song->set_id_user_lif($user->get_id_user_lif());
                $song->add();
                $this->_error_msg .= "Chanson ajoutée avec succés!";
                $form = null;
            }


            return Redirect::to_action('song@add')
                            ->with('error', true)
                            ->with('form', $form)
                            ->with('error_msg', $this->_error_msg);
        }
    }

}