<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('user')) {
            return redirect()->to(base_url());
        }
        return view('login');
    }
    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $user = $this->request->getVar('user');
        $pass = $this->request->getVar('pass');
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $data = $model->where('user', $user)->first();
        if ($data) {
            $password = $data['pass'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'user'     => $data['user'],
                    'name'     => $data['name'],
                    'level'     => $data['level'],
                    'logged_in'     => TRUE
                ];
                $session->setFlashdata('msg', "Welcome back, " . $ses_data['name']);
                $session->set($ses_data);
                return redirect()->to(base_url());
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'User tidak ditemukan');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
