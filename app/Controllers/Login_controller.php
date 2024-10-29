<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login_controller extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        if (!empty($this->session->get('user')['username'])) {
            redirect()->to(base_url('user'))->send();
            exit();
        }
    }

    public function login()
    {
        return view('login');
    }

    public function login_function()
    {
        $model = new LoginModel();
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $users = $model->logincheck($username);

        if (!empty($users) && password_verify($password, $users->user_password)) {
            $sessionData = [
                'id'       => $users->id,
                'username' => $users->user_name,
                'Since'     => (new \DateTime($users->Created_on))->format('jS F, Y')
            ];
            session()->set("user", $sessionData);
            // Check the changepass setting in the .env file
            $changePass = getenv('changepass');
            
            // Redirect based on changepass value
            if (empty($changePass) || strtolower($changePass) === 'false') {
                return redirect()->to(base_url('user/profile'));
            } else {
                return redirect()->to(base_url('user'));
            }

        } else {
            session()->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to(base_url());
        }
    }
}
