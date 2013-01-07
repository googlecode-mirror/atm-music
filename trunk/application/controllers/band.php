<?php

class Band_Controller extends Base_Controller {

    private $_error_msg = "";
    private $_error_form = false;

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $band = Band::from_id($user->get_id_user_lif());

            return View::make('content.band.index')
                            ->with('band', $band);
        }
    }

    public function action_add() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            return View::make('content.band.add');
        }
    }

    public function action_add_band() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            $band = new Band(null);
            if ($_POST['name'] != "")
                $band->set_name_band($_POST['name']);
            else {
                $this->_error_msg = "Il y a une erreur dans le nom du groupe. <br> ";
                $this->_error_form = true;
            }

            if (is_numeric($_POST['anneeF']) and preg_match("/^[0-2][0-9]{3}+$/", $_POST['anneeF']) == 1)
                $band->set_date_form_band($_POST['anneeF']);


            else {
                $this->_error_msg .= "Il y a une erreur dans la date de formation (Format : AAAA).<br> ";
                $this->_error_form = true;
            }

            if (is_numeric($_POST['anneeD']) or $_POST['anneeD'] == "")
                $band->set_date_disband_band($_POST['anneeD']);


            if ($this->_error_form == false) {              
                $band->set_id_user_lif($user->get_id_user_lif());
                $band->add();

                return Redirect::to_action('band');
            } else {
                return Redirect::to_action('band@add')
                                ->with('error', true)
                                ->with('form', $_POST)
                                ->with('error_msg', $this->_error_msg);
            }
        }
    }

}