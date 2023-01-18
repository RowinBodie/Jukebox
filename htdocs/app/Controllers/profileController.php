<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class ProfileController extends Controller
{
    // a redirect after the user logs in so when this gives a error the user is not correctly loggedin.
    public function index()
    {
        $session = session();
        echo "Hello : ".$session->get('name');
        return redirect()->to('/home');
    }
}