<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
         * 
         * 
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
        
        public function is_logged()
        {
            $user = Session::get('user');
            
            if(isset($user))
            {
                 $playlist = Playlist::get_for_display($user->get_id_user_lif()); 
                 Session::put('playlist', $playlist);
                 return ($user);
            }
                
            else
                return false;
        }

}