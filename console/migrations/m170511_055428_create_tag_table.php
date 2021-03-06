<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m170511_055428_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'frequency' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tag');
    }
}
