<?php

namespace getSongs;

class getSongs extends \CodeIgniter\Model{

    protected $table = "songs";

    protected $allowedFields = ["id","name","duration","description","genre"];
}