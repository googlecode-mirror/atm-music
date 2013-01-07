<?php

class Signin_Controller extends Base_Controller {

    private $_username;
    private $_password;
    private $_name;
    private $_fname;
    private $_client_msg = null;
    private $_error_form = false;

    public function action_index() {
        return View::make('signin.index');
    }

    public function action_add_user() {
        if($_POST['user'] != "")
             $this->_username = $_POST['user'];
        else
            $this->_error_form = true;
        
               
        if($_POST['name'] != "" and $this->_error_form == false)
            $this->_name = $_POST['name'];
        else
            $this->_error_form = true;
        
        if($_POST['fname'] != "" and $this->_error_form == false)
            $this->_fname = $_POST['fname'];
        else
            $this->_error_form = true;
        
        if($_POST['pw'] != "" and $this->_error_form == false)
            $this->_password = Hash::make($_POST['pw']);
        else
            $this->_error_form = true;
        
        
        if ($this->_error_form == true) {
            $this->_client_msg = "Veuillez remplir tous les champs svp";
           return Redirect::to_action('signin')
                       ->with('error_msg', $this->_client_msg);
        } else {
            $user = new User_lif(null, $this->_username, $this->_password, $this->_name, $this->_fname, null);
            if ($user->check_exists() == false and $this->_error_form == false) {
               $user->set_id_user_lif($user->add());
               $user->load(); 
               Session::put('user',$user);
                $this->_client_msg = "Enregistrement réussi ! Bienvenue" . $this->_username;
                return Redirect::to_action('home@index');
            } else {
                $this->_client_msg = "Le nom d'utilisteur est déjà utilisé. Veuillez en saisir un nouveau.";
                return Redirect::to_action('signin')
                       ->with('error_msg', $this->_client_msg);
            }
        }
    }

}