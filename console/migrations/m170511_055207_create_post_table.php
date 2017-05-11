<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170511_055207_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'tags' => $this->text(),
            'create_time' => $this->datetime(),
            'update_time' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
