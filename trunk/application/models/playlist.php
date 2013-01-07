<?php

/**
 * Description of band
 *
 * @author Remi
 */
class Playlist extends Eloquent {

    public static $table = "playlist";
    protected $_id_playlist;
    protected $_name_playlist;
    protected $_update;

    function __construct($_id_playlist = null, $_name_playlist = null, $_update = null) {
        $this->_id_playlist = $_id_playlist;
        $this->_name_playlist = $_name_playlist;
        $this->_update = $_update;
    }

    public function add() {
        $play = DB::table(Playlist::$table)
                ->insert_get_id(array('id_playlist' => null,
                                'name_playlist' => $this->_name_playlist,
                                'date_creation_playlist' => $this->_update));
        $user = Session::get('user');
        $admin = new adminPlaylist($user->get_id_user_lif(),$play,'A');
        $admin->add();
        
        return $user;
    }
    
    public function load()
    {
        $res = DB::query('SELECT * FROM PLAYLIST WHERE id_playlist = '.$this->_id_playlist);
        $this->_name_playlist = $res[0]->name_playlist;
        $this->_update = $res[0]->date_creation_playlist;
        
        return $this;
    }
    
    public function get_admin()
    {
        return DB::query('SELECT ap.id_user_lif, ul.username_user_lif FROM adminplaylist ap JOIN user_lif ul ON ap.id_user_lif = ul.id_user_lif WHERE id_playlist = ? AND code_admin = "I"',$this->get_id_playlist());
    }
    public static function get_for_display($id_user)
    {
        return DB::query('SELECT * FROM `adminplaylist` ad JOIN playlist p ON ad.id_playlist = p.id_playlist WHERE ad.id_user_lif = ?',$id_user);
    }
    public function get_id_playlist() {
        return $this->_id_playlist;
    }

    public function set_id_playlist($_id_playlist) {
        $this->_id_playlist = $_id_playlist;
    }

    public function get_name_playlist() {
        return $this->_name_playlist;
    }

    public function set_name_playlist($_name_playlist) {
        $this->_name_playlist = $_name_playlist;
    }

    public function get_update() {
        return $this->_update;
    }

    public function set_update($_update) {
        $this->_update = $_update;
    }

}

?>
