<?php
namespace Application\Controllers;

use Core;

class Session_Controller extends Core\App_Controller {
	public function login() {
		global $CONFIG;
		global $__post;

		if ($__post) {
			if (!empty($__post['email']) && !empty($__post['secret'])) {
				// check if user exists
				if ($user = $this->load()->model('Users')->get_by(['email'=>$__post['email']])) {
					// verify password
					if (password_verify($__post['secret'], $user->secret)) {
						// login successful
						$_SESSION['app']['user'] = [
							'id' => $user->id,
							'name' => $user->name,
							'email' => $user->email
						];

						redirect_to('posts/index');
					}
					else {
						$CONFIG['msg']['error'][] = 'Login error, please try again';
					}
				}
				else {
					$CONFIG['msg']['error'][] = 'Login error, please try again';
				}
			}
			else {
				$CONFIG['msg']['error'][] = 'Login error, please try again';
			}
		}

		$this->load()->view('session/login');
	}

	public function logout() {
        session_destroy();
        session_unset();
        redirect_to('session/login');
    }
}