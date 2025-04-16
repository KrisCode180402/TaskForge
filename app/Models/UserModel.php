<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role_id'];
    protected $useTimestamps = true;

    // Automatically hash the password before insert or update operations.
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash the password using PHP's password_hash() function.
     * Uses password_needs_rehash() to ensure the password is only rehashed if needed.
     *
     * @param array $data
     * @return array
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            // Only hash if the password needs to be hashed (i.e. it's not already hashed)
            if (password_needs_rehash($data['data']['password'], PASSWORD_DEFAULT)) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            }
        }
        return $data;
    }
}
