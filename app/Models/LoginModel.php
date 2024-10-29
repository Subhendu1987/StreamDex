<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
   
    public function listuser($user)
    {
        $builder = $this->db->table('site_user');
        $builder->select('*');

        $query = $builder->get();

        return $query->getResultArray();
    }
    public function logincheck($user)
    {
        $builder = $this->db->table('site_user');

        if ($user) {
            $builder->where('user_name', $user);
        }

        $query = $builder->get();

        return $query->getRow();
    }

}
