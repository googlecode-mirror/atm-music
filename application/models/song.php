<?php

/**
 * Description of band
 *
 * @author Remi
 */
class song extends Eloquent {

    public static $table = "song";
    protected $_id_song;
    protected $_id_user_lif;
    protected $_id_kind;
    public $_id_album;
    protected $_title_song;
    protected $_date_song;
    protected $_length_song;
    protected $_path_song;
    protected $_track_song;

    function __construct($_id_song = null, $_id_user_lif = null, $_title_song = null, $_date_song = null, $_length_song = null, $_path_song = null, $_track_song = null) {
        $this->_id_song = $_id_song;
        $this->_id_user_lif = $_id_user_lif;
        $this->_title_song = $_title_song;
        $this->_date_song = $_date_song;
        $this->_length_song = $_length_song;
        $this->_path_song = $_path_song;
        $this->_track_song = $_track_song;
    }

    public static function all_completed($search) {
        return DB::query('SELECT * FROM song s JOIN songalbum sa ON s.id_song = sa.id_song JOIN album a ON sa.id_album = a.id_album JOIN band b On a.id_band = b.id_band JOIN songkind sk ON s.id_song = sk.id_song WHERE s.title_song LIKE "%' . $search . '%" or a.name_album LIKE "%' . $search . '%" or b.name_band LIKE "%' . $search . '%"');
    }

    public static function from_name_song($name) {
        return DB::table(Song::$table)->where('title_song', 'LIKE', '%' . $name . '%')->get();
    }

    public static function from_id($id) {
        $song = DB::table(Song::$table)
                        ->where('id_user_lif', '=', $id)->get();

        return $song;
    }

    public function complete() {
        $array = DB::query('SELECT * FROM song s JOIN songalbum sa ON s.id_song = sa.id_song JOIN album a ON sa.id_album = a.id_album JOIN band b On a.id_band = b.id_band WHERE s.id_song = "' . $this->_id_song . '"');
        $this->name_album = $array[0]->name_album;
        $this->name_band = $array[0]->name_band;

        return $this;
    }

    public function check_exists() {

        $exist = DB::query('Select count(*) as exist FROM ' . SongAlbum::$table . ' WHERE id_album = ? and id_song IN (Select id_song FROM song WHERE title_song = ?)', array($this->_id_album, $this->_title_song));

        if ($exist[0]->exist)
            return true;
        else
            return false;


        return $exist[0]->exist;
    }

    public function add() {
        $song = DB::table(Song::$table)
                ->insert_get_id(array('id_song' => null,
            'id_user_lif' => $this->_id_user_lif,
            'title_song' => $this->_title_song,
            'length_song' => $this->_length_song,
            'path_song' => $this->_path_song,
            'track_song' => $this->_track_song,
            'date_song' => $this->_date_song));

        $songAlbum = DB::table(SongAlbum::$table)
                ->insert(array('id_song' => $song,
            'id_album' => $this->_id_album));

        foreach ($this->_id_kind as $kind) {
            if (trim($kind) != '') {
                DB::table(SongKind::$table)
                        ->insert(array('id_song' => $song,
                            'name_kind' => trim($kind)));
            }
        }

        return $song;
    }

    public function load() {
        $res = DB::query('SELECT * FROM song WHERE id_song = '.$this->_id_song);
        $this->_title_song = $res[0]->title_song;
        $this->_length_song = $res[0]->length_song;
        
        $this->complete();
        return $this;
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

    public function get_id_user_lif() {
        return $this->_id_user_lif;
    }

    public function set_id_user_lif($_id_user_lif) {
        $this->_id_user_lif = $_id_user_lif;
    }

    public function get_id_kind() {
        return $this->_id_kind;
    }

    public function set_id_kind($_id_kind) {
        $this->_id_kind = $_id_kind;
    }

    public function get_title_song() {
        return $this->_title_song;
    }

    public function set_title_song($_title_song) {
        $this->_title_song = $_title_song;
    }

    public function get_length_song() {
        return $this->_length_song;
    }

    public function set_length_song($m, $s) {
        $this->_length_song = $m . "'" . $s;
    }

    public function get_path_song() {
        return $this->_path_song;
    }

    public function set_path_song($_path_song) {
        $this->_path_song = $_path_song;
    }

    public function get_track_song() {
        return $this->_track_song;
    }

    public function set_track_song($_track_song) {
        $this->_track_song = $_track_song;
    }

    public function get_date_song() {
        return $this->_date_song;
    }

    public function set_date_song($year) {
        $this->_date_song = $year;
    }

}

?>
