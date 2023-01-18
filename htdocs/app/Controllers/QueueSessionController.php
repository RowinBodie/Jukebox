<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class QueueSessionController extends Controller
{
    // controller for making connections with the queue session.
    // create session
    public function createSession()
    {
        session()->set("queue", []);
    }
    // remove the session
    public function emptySession()
    {
        session()->remove("queue");
    }
    // check if session is made
    public function isSet()
    {
        if(isset($_SESSION['queue']) ){
            return true;
        }
        else{
            return false;
        }
    }
    // returns the session
    public function getSession()
    {
        return $_SESSION['queue'];
    }

    // push data into session
    public function addSong($id)
    {
        session()->push("queue", [$id]);
    }

    // set the session with data
    public function setData($queue)
    {
        session()->set("queue", $queue);
    }
}