<?php

class Info_Controller extends Base_Controller {

    public function action_index() {
        $user = $this->is_logged();
        if ($user === false) {
            return Redirect::to_action('login');
        } else {
            return View::make('info.index');
        }
        
                       
    }

    
}

