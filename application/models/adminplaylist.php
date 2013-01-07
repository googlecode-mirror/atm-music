<?php

/**
 * Description of band
 *
 * @author Remi
 */
class adminPlaylist extends Eloquent {
    
    public static $table = "adminPlaylist";
    protected $_id_user_lif;
    protected $_id_playlist;
    protected $_code_admin;
    
    function __construct($_id_user_lif = null, $_id_playlist = null, $_code_admin = null) {
        $this->_id_user_lif = $_id_user_lif;
        $this->_id_playlist = $_id_playlist;
        $this->_code_admin = $_code_admin;
    }

    
    public static function get_completed($id){
        return DB::query('SELECT * FROM adminplaylist ad JOIN playlist p ON ad.id_playlist = p.id_playlist WHERE ad.id_user_lif = ?', $id);
    }
                
    public function check_exists(){
        $res = DB::query('SELECT COUNT(*) as count FROM adminplaylist WHERE id_user_lif = '.$this->_id_user_lif.' and id_playlist = '.$this->_id_playlist.' ');
        return $res[0]->count;
        
        
    }
    
    
    
    public function add(){
        $ad = DB::table(adminPlaylist::$table)
                ->insert_get_id(array('id_user_lif' => $this->_id_user_lif,
                                'id_playlist' => $this->_id_playlist,
                                'code_admin' => $this->_code_admin));
        return $ad;
    }
    
    public function delete(){
        return DB::query('DELETE FROM '.adminPlaylist::$table.' where id_user_lif = '.$this->_id_user_lif.' and id_playlist = '.$this->_id_playlist);
    }
    
    
    
    public function get_id_user_lif() {
        return $this->_id_user_lif;
    }

    public function set_id_user_lif($_id_user_lif) {
        $this->_id_user_lif = $_id_user_lif;
    }

    public function get_id_playlist() {
        return $this->_id_playlist;
    }

    public function set_id_playlist($_id_playlist) {
        $this->_id_playlist = $_id_playlist;
    }

    public function get_code_admin() {
        return $this->_code_admin;
    }

    public function set_code_admin($_code_admin) {
        $this->_code_admin = $_code_admin;
    }


   

}
   
?>
