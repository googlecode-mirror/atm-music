<?php

/**
 * Description of band
 *
 * @author Remi
 */
class Album extends Eloquent {
    
    public static $table = "album";
    protected $_id_album;
    protected $_id_band;
    protected $_id_user_lif;
    protected $_name_album;
    protected $_date_prod_album;
    
    function __construct($_id_album = null, $_id_band = null, $_id_user_lif = null, $_name_album = null, $_date_prod_album = null) {
        $this->_id_album = $_id_album;
        $this->_id_band = $_id_band;
        $this->_id_user_lif = $_id_user_lif;
        $this->_name_album = $_name_album;
        $this->_date_prod_album = $_date_prod_album;
    }
    
     public static function from_name_album($name)
    {
        return DB::table(Album::$table)->where('name_album', 'LIKE', '%'.$name.'%')->get(array('id_album','id_band', 'name_album','date_prod_album'));
        
    }
    
    public static function from_id($id)
    {
        $album = DB::table(Album::$table)
                ->where('id_user_lif', '=', $id)->get();
        
        return $album;
    }
    
    public function complete()
    {
        $band = DB::table(Band::$table)
                    ->where('id_band', '=', $this->_id_band)->first();
        $this->name_band = $band->name_band;
        return $this;
    }

    public static function get_from_id($id)
    {
        return DB::table(Album::$table)
                ->where('id_band', '=', $id)->get();
    }
                
    public function check_exists(){
        $album =  DB::query("SELECT COUNT(*) as count FROM album a JOIN band b ON a.id_band = b.id_band WHERE name_album = \"".$this->_name_album."\" and b.id_band = \"".$this->_id_band."\"");
        
       return $album[0]->count; 
        
    }
    
    public function add(){
        
        if($this->check_exists() == 0)
        {
            return DB::table(Album::$table)->insert_get_id(array('id_album' => null,
                                'id_band' => $this->_id_band,
                                'id_user_lif' => $this->_id_user_lif,
                                'name_album' => $this->_name_album,
                                'date_prod_album' => $this->_date_prod_album));
        }
                
    }
    
    
    
    
    public function load()
    {
      echo true;   
    }

    public function get_id_album() {
        return $this->_id_album;
    }

    public function set_id_album($_id_album) {
        $this->_id_album = $_id_album;
    }
    
    public function get_id_band() {
        return $this->_id_band;
    }

    public function set_id_band($_id_band) {
        $this->_id_band = $_id_band;
    }

    
    public function get_id_user_lif() {
        return $this->_id_user_lif;
    }

    public function set_id_user_lif($_id_user_lif) {
        $this->_id_user_lif = $_id_user_lif;
    }

    public function get_name_album() {
        return $this->_name_album;
    }

    public function set_name_album($_name_album) {
        $this->_name_album = $_name_album;
    }

    
    public function get_date_prod_album() {
        return $this->_date_prod_album;
    }

    public function set_date_prod_album($year) {
        $this->_date_prod_album = $year;
    }




}
   
?>
