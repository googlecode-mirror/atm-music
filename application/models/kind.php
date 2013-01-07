<?php

/**
 * Description of band
 *
 * @author Remi
 */
class Kind extends Eloquent {
    
    public static $table = "kind";
    protected $_name_kind;
   
    function __construct( $_name_kind = null) {
        $this->_name_kind = $_name_kind;
    }

             
    public function get_song_stats($nb_song, $year = null)
    {
        $count = DB::query('SELECT count(*) as count FROM  songkind where name_kind = "'.$this->_name_kind.'" ORDER BY count ASC');
        $this->percent = (($count[0]->count)/($nb_song)*100);
    }
    public function add()
    {
        if($this->check_exist() == 0)
        {
            return DB::table(Kind::$table)->insert(array("name_kind" => $this->_name_kind));
        }
           
        
    }
  
    public function check_exist()
    {
        $count = DB::query("SELECT COUNT(*) as Test FROM kind WHERE name_kind = '$this->name_kind'");
        return $count[0]->test;
    }

    public function get_name_kind() {
        return $this->_name_kind;
    }

    public function set_name_kind($_name_kind) {
        $this->_name_kind = $_name_kind;
    }






}
   
?>
