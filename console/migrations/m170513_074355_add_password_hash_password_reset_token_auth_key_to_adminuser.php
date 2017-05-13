<?php

use yii\db\Migration;

class m170513_074355_add_password_hash_password_reset_token_auth_key_to_adminuser extends Migration
{
    public function up()
    {
      $this->addColumn('adminuser', 'password_hash', $this->string());
      $this->addColumn('adminuser', 'password_reset_token', $this->string());
      $this->addColumn('adminuser', 'auth_key', $this->string());
    }

    public function down()
    {
      $this->dropColumn('adminuser', 'password_hash', $this->string());
      $this->dropColumn('adminuser', 'password_reset_token', $this->string());
      $this->dropColumn('adminuser', 'auth_key', $this->string());
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
