<?php

class Login_Controller extends Base_Controller {

    private $_username;
    private $_password;
    private $_id;
    private $_error_form = false;

    public function action_index() {
        $user = Session::get('user');
        if (!isset($user))
            return View::make('login.index');
        return View::make('login.index')
                        ->with('logged', true);
    }

    public function action_log() {
        $user = $this->is_logged();
        if ($user === false) {
            $try = new User_lif();
            $try->set_username_user_lif($_POST['user']);
            $try->set_password_user_lif($_POST['pw']);

            $this->_id = $try->attempt();

            if ($this->_id) {
                $user = new User_lif();
                $user->set_id_user_lif($this->_id);
                $user->load();
                Session::put('user', $user);
                return Redirect::to_action('home@index');
            }

            $this->_error_form = "Identifiant ou mot de passe éronné, veuillez réessayer svp.";
            return Redirect::to_action('login')
                            ->with('error_msg', $this->_error_form);
        }
    }

    public function action_logout() {
        Session::forget('user');
        return Redirect::to_action('home@index');
    }


}