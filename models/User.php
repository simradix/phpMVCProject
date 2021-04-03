<?php
namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function tableName(): string 
    {
        return 'users';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>24]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'=>'password']]
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password'];
    }
}