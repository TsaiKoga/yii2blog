<?php

use yii\db\Migration;

class m170511_060038_add_status_to_comment extends Migration
{
    public function up()
    {
      $this->addColumn('comment', 'status', $this->integer());
      // creates index for column `status`
      $this->createIndex(
          'idx-comment-status',
          'comment',
          'status'
      );
      // add foreign key for table `commentstatus`
      $this->addForeignKey(
          'fk-comment-status',
          'comment',
          'status',
          'commentstatus',
          'id',
          'CASCADE'
      );
    }

    public function down()
    {
      // drops foreign key for table `commentstatus`
        $this->dropForeignKey(
            'fk-comment-status',
            'comment'
        );

        // drops index for column `status`
        $this->dropIndex(
            'idx-comment-status',
            'comment'
        );
      $this->dropColumn('comment', 'status', $this->integer());
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
