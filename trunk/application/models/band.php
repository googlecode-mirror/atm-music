<?php

/**
 * Description of band
 *
 * @author Remi
 */
class Band extends Eloquent {

    public static $table = "band";
    protected $_id_band;
    protected $_id_user_lif;
    protected $_name_band;
    protected $_date_form_band;
    protected $_date_disband_band;

    function __construct($_id_band = null, $_id_user_lif = null, $_name_band = null, $_date_form_band = null, $_date_disband_band = null) {
        $this->_id_band = $_id_band;
        $this->_id_user_lif = $_id_user_lif;
        $this->_name_band = $_name_band;
        $this->_date_form_band = $_date_form_band;
        $this->_date_disband_band = $_date_disband_band;
    }

    public static function from_name_band($name) {
        return DB::table(Band::$table)->where('name_band', 'LIKE', '%' . $name . '%')->get(array('id_band', 'name_band', 'date_form_band'));
    }

    public static function from_id($id) {
        $band = DB::table(Band::$table)
                        ->where('id_user_lif', '=', $id)->get();

        return $band;
    }

    public function check_exists() {
        $band = DB::query("SELECT COUNT(*) as count FROM band where name_band = '$this->_name_band'");
        return $band[0]->count;
    }

    public function add() {
        if ($this->check_exists() == 0) {
          return DB::table(Band::$table)
                    ->insert_get_id(array('id_band' => null,
                        'id_user_lif' => $this->_id_user_lif,
                        'name_band' => $this->_name_band,
                        'date_form_band' => $this->_date_form_band,
                        'date_disband_band' => $this->_date_disband_band));
        }

      
    }

    public function load() {
        $user = DB::table(Band::$table)
                ->where('id_band', '=', $this->_id_band)
                ->first();

        $this->_name_band = $user->name_band;
        $this->_id_user_lif = $user->id_user_lif;
        $this->_date_form_band = $user->date_form_band;
        $this->_date_disband_band = $user->date_disband_band;

        $date = str_replace('-', '', $this->_date_form_band);

        $this->inline_dateY_form = substr($date, 0, 4);
        $this->inline_dateM_form = substr($date, 4, 2);

        $date = str_replace('-', '', $this->_date_disband_band);
        $this->inline_dateY_disband = substr($date, 0, 4);
        $this->inline_dateM_disband = substr($date, 4, 2);

        return $this;
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

    public function get_name_band() {
        return $this->_name_band;
    }

    public function set_name_band($_name_band) {
        $this->_name_band = $_name_band;
    }

    public function get_date_form_band() {
        return $this->_date_form_band;
    }

    public function set_date_form_band($year) {
        $this->_date_form_band = $year;
    }

    public function get_date_disband_band() {
        return $this->_date_disband_band;
    }

    public function set_date_disband_band($year) {
        $this->_date_disband_band = $year;
    }

}

?>
