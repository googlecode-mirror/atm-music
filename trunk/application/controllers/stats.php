<?php

class Stats_Controller extends Base_Controller {

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $album_count = Album::count();
            $band_count = band::count();
            $playlist_count = Playlist::count();
            $user_count = User_lif::count();
            $best_year_song = DB::query('SELECT date_song, count(*) as count FROM song GROUP BY date_song HAVING count ORDER BY count DESC LIMIT 1');
            $max_in_playlist = DB::query('SELECT count(s.id_song) as count, b.name_band,  s.`title_song` FROM song s JOIN songplaylist so ON s.id_song = so.id_song JOIN songalbum son ON s.id_song = son.id_song JOIN album a ON son.id_album = a.id_album JOIN band b ON a.id_band = b.id_band GROUP BY s.title_song HAVING count ORDER BY count DESC LIMIT 3');

            //var_dump($best_year_song);
        }
        return View::make('stats.index')
                        ->with('song_count', $song_count)
                        ->with('album_count', $album_count)
                        ->with('best_year_song', $best_year_song)
                        ->with('playlist_count', $playlist_count)
                        ->with('user_count', $user_count)
                        ->with('max_in_playlist', $max_in_playlist)
                        ->with('band_count', $band_count);
    }

    public function action_get_song_kind() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $all_genres = DB::query('SELECT count(id_song) as count , name_kind FROM songkind GROUP BY name_kind HAVING count ORDER BY count DESC');
            $data = array();
            $other = 0;
            $other_count = 0;
            foreach ($all_genres as $value) {
                if (($value->count / $song_count * 100) < 4) {
                    $other += $value->count / $song_count * 100;
                    $other_count++;
                }

                else
                    $data[] = array($value->name_kind, $value->count / $song_count * 100, $value->count);
            }
            $data[] = array('Autres (' . $other_count . ' genres < 4%)', $other, intval($other * 360 / 100));
            echo json_encode($data);
        }
    }

    public function action_get_band_kind() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $all_genres_band = DB::query('SELECT COUNT( DISTINCT (b.id_band) ) as count , sk.name_kind FROM  `band` b JOIN album a ON b.id_band = a.id_band JOIN songalbum sa ON a.id_album = sa.id_album JOIN song s ON sa.id_song = s.id_song JOIN songkind sk ON s.id_song = sk.id_song GROUP BY sk.name_kind HAVING count ORDER BY count DESC ');
            $data = array();
            foreach ($all_genres_band as $value)
                $data[] = array($value->name_kind, $value->count);
            echo json_encode($data);
        }
    }

    public function action_get_album_kind() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $all_genres_band = DB::query('SELECT COUNT( DISTINCT (a.id_album) ) as count , sk.name_kind FROM album a JOIN songalbum sa ON a.id_album = sa.id_album JOIN song s ON sa.id_song = s.id_song JOIN songkind sk ON s.id_song = sk.id_song GROUP BY sk.name_kind HAVING count ORDER BY count DESC');
            $data = array();
            foreach ($all_genres_band as $value)
                $data[] = array($value->name_kind, $value->count);
            echo json_encode($data);
        }
    }

    public function action_get_album_date() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $all_date_album = DB::query('SELECT COUNT( DISTINCT (a.id_album) ) as count , a.date_prod_album FROM album a GROUP BY a.date_prod_album HAVING count ORDER BY date_prod_album DESC');
            $data = array();
            foreach ($all_date_album as $value) {
                if($value->date_prod_album != -1)
                    $data[] = array($value->date_prod_album, $value->count);
            }
            echo json_encode($data);
        }
    }
    
    public function action_get_song_date() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $song_count = Song::count();
            $all_date_song = DB::query('SELECT COUNT( DISTINCT (s.id_song) ) as count , s.date_song FROM song s GROUP BY s.date_song HAVING count ORDER BY s.date_song DESC');
            $data = array();
            foreach ($all_date_song as $value) {
                if($value->date_song != -1)
                    $data[] = array($value->date_song, $value->count);
            }
            echo json_encode($data);
        }
    }

}

