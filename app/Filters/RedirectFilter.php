<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RedirectFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa sebelum request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Cek jika user berhasil login dan sedang dari form login
        if (session('isLoggedIn') && $request->getMethod() === 'post' && $request->uri->getPath() === 'login') {
            return redirect()->to('/contact');
        }

        return $response;
    }
}