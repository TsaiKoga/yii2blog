<?php

use yii\db\Migration;

class m170515_095509_add_remind_to_comment extends Migration
{
    public function up()
    {
        $this->addColumn('comment', 'remind', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->removeColumn('comment', 'remind', 'integer');
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
