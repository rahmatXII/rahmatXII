<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table      = 'tb_user';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'id';
     protected $allowedFields=['nama','password','username','jenis_kelamin','jenis'];
}