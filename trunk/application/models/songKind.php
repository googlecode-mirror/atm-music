<?php

/**
 * Description of band
 *
 * @author Remi
 */
class SongKind extends Eloquent {
    
    public static $table = "songKind";
    protected $_name_kind;
    
    function __construct($_name_kind = null) {
        $this->_name_kind = $_name_kind;
    }
    
    public function get_name_kind() {
        return $this->_name_kind;
    }

    public function set_name_kind($_name_kind) {
        $this->_name_kind = $_name_kind;
    }



   
   





}
   
?>
