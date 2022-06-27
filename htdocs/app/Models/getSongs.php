<?php

namespace App\Models;

class getSongs extends \CodeIgniter\Model{

    protected $table = "songs";

    protected $allowedFields = ["id","name","duration","description","genre"];
}