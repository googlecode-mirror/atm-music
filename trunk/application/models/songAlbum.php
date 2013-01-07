<?php

/**
 * Description of band
 *
 * @author Remi
 */
class SongAlbum extends Eloquent {
    
    public static $table = "songAlbum";
    protected $_id_song;
    protected $_id_album;
   
    function __construct($_id_song, $_id_album) {
        $this->_id_song = $_id_song;
        $this->_id_album = $_id_album;
    }
    
    public function get_id_song() {
        return $this->_id_song;
    }

    public function set_id_song($_id_song) {
        $this->_id_song = $_id_song;
    }

    public function get_id_album() {
        return $this->_id_album;
    }

    public function set_id_album($_id_album) {
        $this->_id_album = $_id_album;
    }






}
   
?>
