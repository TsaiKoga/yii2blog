<?php

use yii\db\Migration;

/**
 * Handles the creation of table `commentstatus`.
 */
class m170511_055723_create_commentstatus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('commentstatus', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'position' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('commentstatus');
    }
}
