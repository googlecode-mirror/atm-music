<?php

class Album_Controller extends Base_Controller {

    private $_error_msg = "";
    private $_error_form = false;

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $album_std = Album::from_id($user->get_id_user_lif());
            $album = array();
            foreach ($album_std as $value) {
                $one = new Album($value->id_album, $value->id_band, $value->id_user_lif, $value->name_album, $value->date_prod_album);
                $one->complete();
                array_push($album, $one);
            }
            return View::make('content.album.index')
                            ->with('album', $album);
        }
    }

    public function action_add() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $band = Band::all();
            $band_for_select = array();
            foreach ($band as $value) {
                $band_for_select[$value->attributes['id_band']] = $value->attributes['name_band'];
            }
            return View::make('content.album.add')
                            ->with('band', $band_for_select);
        }
    }

    public function action_add_album() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $album = new Album();
            if ($_POST['name'] != "")
                $album->set_name_album($_POST['name']);
            else {
                $this->_error_msg = "Il y a une erreur dans le nom de l'album.";
                $this->_error_form = true;
            }

            if (is_numeric($_POST['anneeF']) and preg_match("/^[0-2][0-9]{3}+$/", $_POST['anneeF']) == 1)
                $album->set_date_prod_album($_POST['anneeF']);
            else {
                $this->_error_msg .= "<br>Il y a une erreur dans l\'année de production (Format : AAAA).";
                $this->_error_form = true;
            }

            if ($this->_error_form == false) {
                $album->set_id_user_lif($user->get_id_user_lif());
                $album->set_id_band($_POST['band']);
                $album->add();
                return Redirect::to_action('album');
            } else {

                return Redirect::to_action('album@add')
                                ->with('error', true)
                                ->with('form', $_POST)
                                ->with('error_msg', $this->_error_msg);
            }
        }
    }

}