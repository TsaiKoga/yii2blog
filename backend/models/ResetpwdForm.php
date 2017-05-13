<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{
    public $password;
    public $password_repeat;

    public function attributeLabels() {
      return [
        'password' => '密码',
        'password_repeat' => '重复密码',
      ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入必须一致'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = Adminuser::findOne($id);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->password = '*'; // 偷懒，本来是要删掉password字段，因为密码存在passwod_hash中
        // $user.save(); VarDumper::dump($user->errors);exit(0);

        return $user->save() ? $user : null;
    }
}
