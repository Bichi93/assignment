<?php namespace App\Entities;

class User 
{
    protected $id;
    protected $name;
    protected $last_name;
    protected $email;
    protected $phone;
    // public $password_hash;
    // public $created_at;
    // public $updated_at;

    protected $_options = [
        'datamap' => [],
        'casts'   => [],
    ];

    public function __get(string $key)
    {
        if (property_exists($this, $key))
        {
            return $this->$key;
        }
    }

    public function __set(string $key, $value = NULL)
    {
        if (property_exists($this, $key))
        {
            $this->$key = $value;
        }
    }

    public function setPassword(string $password)
    {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }
}