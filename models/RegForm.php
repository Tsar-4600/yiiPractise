<?php

namespace app\models;

use Yii;
use yii\base\Model;
class RegForm extends Model
{
    public  $username,
            $password,
            $confirmPassword,
            $id_role = 1,
            $name,
            $surname,
            $email,
            $telephone,
            $agree;

            
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'confirmPassword', 'email', 'telephone','agree'], 'required'],
            // password is validated by validatePassword()
            [['id_role'], 'integer'],
            [['name', 'surname','phone', 'email', 'telephone', 'passwordConfirm'], 'string', 'max'=> 255],
            [['username'], 'unique', 'message' => 'Такой логин уже есть'],
            ['email', 'email', 'message' => 'Некорреткная почта'],
            ['name', 'match', 'pattern' => '/^[А-Яа-я\s]{5,}$/u', 'message' => 'Только кириллица и пробелы'],
            ['surname', 'match', 'pattern' => '/^[А-Яа-я\s]{5,}$/u', 'message' => 'Только кириллица и пробелы'],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9]{1,}$/u', 'message' => 'Только латиница и цифры'],
            ['password', 'string', 'min' => 6],
            ['passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны совпадать'],
            ['agree', 'boolean'],
            ['agree', 'compare', 'compareValue' => true, 'message' => 'Необходимо согласиться для обработки ваших персональных данных'],

        ];
    }
    public function attributeLabels(){
        return[
            'username' => 'username',
            'password' => 'Пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'passwordConfirm' => 'Повторить пароль',
            'agree' => 'Согласие на обработку данных',
            'email'=> 'Почта',
            'telephone' => 'Телефон',
            'id_role'=>'Id role'
        ];
    }
   
    
}