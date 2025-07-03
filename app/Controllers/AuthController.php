<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel; 
use App\Models\DiskonModel;

class AuthController extends BaseController
{
    protected $diskonModel;

    function __construct()
    {
        helper('form');
        $this->user= new UserModel();
        $this->diskonModel = new DiskonModel();
    }

    public function login()
{
    if ($this->request->getPost()) {
        $rules = [
            'username' => 'required|min_length[6]',
            'password' => 'required|min_length[7]|numeric',
        ];

        if ($this->validate($rules)) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first(); //pasw 1234567

            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'username' => $dataUser['username'],
                        'role' => $dataUser['role'],
                        'isLoggedIn' => TRUE
                    ]);

                    // Check discount for today with timezone offset
                    $timezoneOffset = $this->request->getPost('timezone_offset');
                    $currentDate = new \DateTime('now', new \DateTimeZone('UTC'));
                    if ($timezoneOffset !== null) {
                        // Adjust date by timezone offset in minutes
                        $offsetInterval = new \DateInterval('PT' . abs($timezoneOffset) . 'M');
                        if ($timezoneOffset > 0) {
                            $currentDate->sub($offsetInterval);
                        } else {
                            $currentDate->add($offsetInterval);
                        }
                    }
                    $today = $currentDate->format('Y-m-d');
                    $diskon = $this->diskonModel->where('tanggal', $today)->first();
                    if ($diskon) {
                        session()->set('diskon_nominal', $diskon->nominal);
                    } else {
                        session()->remove('diskon_nominal');
                    }

                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back();
        }
    }

    return view('v_login');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}