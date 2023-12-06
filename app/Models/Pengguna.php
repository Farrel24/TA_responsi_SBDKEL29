<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model implements Authenticatable
{
    protected $table = 'pengguna'; // Adjust with your actual table name
    protected $primaryKey = 'id_user'; // Adjust with your actual primary key column name

    // ... other model code

    public function getAuthIdentifierName()
    {
        return 'id_user'; // Adjust with your actual primary key column name
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password; // Assuming your password column is named 'password'
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // ... other methods required by the Authenticatable contract
}



