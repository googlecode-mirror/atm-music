<?php

/**
 * Description of band
 *
 * @author Remi
 */
class SongPlaylist extends Eloquent {
    
    public static $table = "songplaylist";
    protected $_id_song;
    protected $_id_playlist;
    protected $_id_user_lif;
    protected $_update;
    
    function __construct($_id_song = null, $_id_playlist = null, $_id_user_lif = null, $_update = null) {
        $this->_id_song = $_id_song;
        $this->_id_playlist = $_id_playlist;
        $this->_id_user_lif = $_id_user_lif;
        $this->_update = $_update;
    }

    public static function all_from_ids($id_pl)
    {
        $res = DB::query('SELECT id_song FROM songplaylist WHERE id_playlist = '.$id_pl.'');
        return $res;
    }
    
    public function remove()
    {
        $res = DB::query('DELETE FROM songplaylist WHERE id_song = '.$this->_id_song.' and id_playlist = '.$this->_id_playlist);
    }
                
    public function check_exists(){
        $user =  DB::table(Album::$table)
                ->where('name_album', '=', $this->_name_album)->count();
        
        if($user >= 1)
            return true;
        else
            return false;    
        
    }
    
    public function add(){
        $user = DB::table(SongPlaylist::$table)
                ->insert(array('id_song' => $this->_id_song,
                                'id_playlist' => $this->_id_playlist,
                                'id_user_lif' => $this->_id_user_lif,
                                'date_added' => date("Y-m-d H:i:s") ));
        return $user;
    }
    
    
    public function get_id_song() {
        return $this->_id_song;
    }

    public function set_id_song($_id_song) {
        $this->_id_song = $_id_song;
    }

    public function get_id_playlist() {
        return $this->_id_playlist;
    }

    public function set_id_playlist($_id_playlist) {
        $this->_id_playlist = $_id_playlist;
    }

    public function get_id_user_lif() {
        return $this->_id_user_lif;
    }

    public function set_id_user_lif($_id_user_lif) {
        $this->_id_user_lif = $_id_user_lif;
    }

    public function get_update() {
        return $this->_update;
    }

    public function set_update($_update) {
        $this->_update = $_update;
    }


    
    




}
   
?>
