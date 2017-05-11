<?php

use yii\db\Migration;

/**
 * Handles the creation of table `poststatus`.
 */
class m170511_055247_create_poststatus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('poststatus', [
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
        $this->dropTable('poststatus');
    }
}
