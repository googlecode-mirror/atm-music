<?php

/**
 * Description of user_lif
 *
 * @author Remi
 */
class User_lif extends Eloquent {

    public static $table = "user_lif";
    protected $_id_user_lif;
    protected $_username_user_lif;
    protected $_password_user_lif;
    protected $_last_name_user_lif;
    protected $_first_name_user_lif;
    protected $_date_creation;

    function __construct($_id_user_lif = null, $_username_user_lif = null, $_password_user_lif = null, $_last_name_user_lif = null, $_first_name_user_lif = null, $_date_creation = null) {
        $this->_id_user_lif = $_id_user_lif;
        $this->_username_user_lif = $_username_user_lif;
        $this->_password_user_lif = $_password_user_lif;
        $this->_last_name_user_lif = $_last_name_user_lif;
        $this->_first_name_user_lif = $_first_name_user_lif;
        $this->_date_creation = date('Y-m-d H:i:s');
        ;
    }

    public function check_exists() {
        $user = DB::table(User_lif::$table)
                        ->where('username_user_lif', '=', $this->_username_user_lif)->count();

        if ($user >= 1)
            return true;
        else
            return false;
    }

    public function add() {
        $user = DB::table(User_lif::$table)
                ->insert_get_id(array('id_user_lif' => null,
            'username_user_lif' => $this->_username_user_lif,
            'password_user_lif' => $this->_password_user_lif,
            'last_name_user_lif' => $this->_last_name_user_lif,
            'first_name_user_lif' => $this->_first_name_user_lif,
            'date_creation' => $this->_date_creation));
        return $user;
    }

    public function attempt() {
        $user = DB::table(User_lif::$table)
                ->where('username_user_lif', '=', $this->_username_user_lif)
                ->first();

        if ($user != null and Hash::check($this->_password_user_lif, $user->password_user_lif))
            return $user->id_user_lif;
        return false;
    }

    public function load() {
        $user = DB::table(User_lif::$table)
                ->where('id_user_lif', '=', $this->_id_user_lif)
                ->first();

        $this->_username_user_lif = $user->username_user_lif;
        $this->_last_name_user_lif = $user->last_name_user_lif;
        $this->_first_name_user_lif = $user->first_name_user_lif;

        return $this;
    }

    public function load_from_username() {
        $user = DB::table(User_lif::$table)
                ->where('username_user_lif', '=', $this->_username_user_lif)
                ->first();

        $this->_id_user_lif = $user->id_user_lif;
        $this->_last_name_user_lif = $user->last_name_user_lif;
        $this->_first_name_user_lif = $user->first_name_user_lif;

        return $this;
    }

    public function get_id_user_lif() {
        return $this->_id_user_lif;
    }

    public function set_id_user_lif($_id_user_lif) {
        $this->_id_user_lif = $_id_user_lif;
    }

    public function get_username_user_lif() {
        return $this->_username_user_lif;
    }

    public function set_username_user_lif($username) {
        $this->_username_user_lif = $username;
    }

    public function get_password_user_lif() {
        return $this->_password_user_lif;
    }

    public function set_password_user_lif($password) {
        $this->_password_user_lif = $password;
    }

    public function get_last_name_user_lif() {
        return $this->_last_name_user_lif;
    }

    public function set_last_name_user_lif($_last_name_user_lif) {
        $this->_last_name_user_lif = $_last_name_user_lif;
    }

    public function get_first_name_user_lif() {
        return $this->_first_name_user_lif;
    }

    public function set_first_name_user_lif($_first_name_user_lif) {
        $this->_first_name_user_lif = $_first_name_user_lif;
    }

    public function get_date_creation() {
        return $this->_date_creation;
    }

    public function set_date_creation($_date_creation) {
        $this->_date_creation = $_date_creation;
    }

}

?>
