<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adminuser`.
 */
class m170511_055352_create_adminuser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('adminuser', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'nickname' => $this->string(),
            'password' => $this->string(),
            'email' => $this->string(),
            'profile' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('adminuser');
    }
}
