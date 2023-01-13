<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SigninController extends Controller
{
    // load page
    public function index()
    {
        helper(['form']);
        echo view('signin');
    } 
    // login function
    public function loginAuth()
    {
        // create session
        $session = session();
        // get model
        $userModel = new UserModel();
        // get data from forms 
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        // using the email to get a user
        $data = $userModel->where('email', $email)->first();
        // check if user exists.
        if($data){
            // get the password
            $pass = $data['password'];
            // compares the two passwords
            $authenticatePassword = password_verify($password, $pass);
            // check if the password aline
            if($authenticatePassword){
                // create a session to login
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/profile');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/signin');
        }
    }
    // deletes all the sessions to logout
    public function logout(){
        session()->remove("email");
        session()->remove("isLoggedIn");
        session()->remove("name");
        session()->remove("id");
        session()->remove("queue");
        return redirect()->to('/home');
    }
}