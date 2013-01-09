<?php

class Playlist_Controller extends Base_Controller {

    private $_error_form = false;
    private $_error_msg = "";

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $playlist = Playlist::get_for_display($user->get_id_user_lif());
            foreach ($playlist as $value) {
                if ($value->code_admin == 'A') {
                    $pl = new Playlist($value->id_playlist);
                    $pl->get_admin();
                    $value->admins = ($pl->get_admin());
                }
            }
            
            return View::make('playlist.index')
                            ->with('playlist', $playlist);
        }
    }

    public function action_add() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            return View::make('playlist.add');
        }
    }

    public function action_add_playlist() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $play = new Playlist();
            if (isset($_POST['playlist']) and $_POST['playlist'] != "")
                $play->set_name_playlist($_POST['playlist']);
            else {
                $this->_error_form = true;
                $this->_error_msg .= "Il y a une erreur dans le nom";
            }

            if ($this->_error_form == false) {
                $play->set_update(date('y-m-d'));
                $this->_error_msg .= "Ajout réussi!";
                $play->add();
                return Redirect::to_action('playlist');
            }
            return Redirect::to_action('playlist@add');
        }
    }

    public function action_display() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $id_playlist = URI::segment(3);
            $adminPlaylist = new adminPlaylist($user->get_id_user_lif(), $id_playlist);
            if ($adminPlaylist->check_exists() == 1) {
                $song_array = array();
                $all = SongPlaylist::all_from_ids($id_playlist);
                foreach ($all as $value) {
                    $song = new Song($value->id_song);
                    $song->load();

                    array_push($song_array, $song);
                }
                $playlist = new Playlist($id_playlist);
                $playlist->load();
                return View::make('playlist.display')
                                ->with('playlist', $playlist)
                                ->with('songs', $song_array);
            }
            else
                return Redirect::to_action('home@index');
        }
    }

    public function action_remove_song_to_playlist() {

        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $id_playlist = $_POST['id_playlist'];
            $adminPlaylist = new adminPlaylist($user->get_id_user_lif(), $id_playlist);
            if ($adminPlaylist->check_exists() == 1) {
                $song_playlist = new SongPlaylist($_POST['id_song'], $_POST['id_playlist']);
                $song_playlist->remove();
            }
            else
                return Redirect::to_action('home@index');
        }
    }

    public function action_add_user_to_playlist() {

        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $username = new User_lif(null, $_POST['username']);

            if ($username->check_exists($_POST['username'])) {
                $username->load_from_username();
                $ap = new adminPlaylist($username->get_id_user_lif(), $_POST['id_playlist']);
                if ($ap->check_exists() == null) {
                    $ap->set_code_admin('I');
                    $ap->add();

                    if ($ap->check_exists() == 1)
                        echo 1;
                    else
                        echo 0;
                }
                else
                    echo -1;
            }
            else
                echo -2;
        }
    }
    public function action_remove_user_from_playlist() {

        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $ap = new adminPlaylist($_POST['id_user'], $_POST['id_playlist']);
            if($ap->check_exists() == 1)
            {
                if($ap->delete() == 1)
                    echo 1;
                else 
                    echo 0;
            }
            else
                echo -1;
            
        }
    }
    
    public function action_delete_playlist()
    {
         $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $playlist = new Playlist($_POST['id']);
            $playlist->delete();
        }
    }

}