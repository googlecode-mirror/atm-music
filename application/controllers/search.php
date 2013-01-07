<?php

class Search_Controller extends Base_Controller {

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $playlist = adminPlaylist::get_completed($user->get_id_user_lif());
            $search = "";
            if (isset($_POST['toSeek']))
                $search = $_POST['toSeek'];

            $song = Song::all_completed($_POST['toSeek']);
            
            return View::make('search.index')
                            ->with('toSeek', $_POST['toSeek'])
                            ->with('playlist', $playlist)
                            ->with('count', count($song))
                            ->with('song', $song);
        }
    }

    function action_add_song_to_playlist() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {            
            $new_song = new SongPlaylist($_POST['id_song'], $_POST['id_playlist'], $user->get_id_user_lif(), null);
            $new_song->add();
        }
    }

}