<?php

use yii\db\Migration;

class m170511_055919_add_status_and_author_id_to_post extends Migration
{
    public function up()
    {
      $this->addColumn('post', 'status', $this->integer());
      // creates index for column `status`
      $this->createIndex(
          'idx-post-status',
          'post',
          'status'
      );
      // add foreign key for table `poststatus`
      $this->addForeignKey(
          'fk-post-status',
          'post',
          'status',
          'poststatus',
          'id',
          'CASCADE'
      );


      $this->addColumn('post', 'author_id', $this->integer());
      // creates index for column `auhtor_id`
      $this->createIndex(
          'idx-post-author_id',
          'post',
          'author_id'
      );
      // add foreign key for table `user`
      $this->addForeignKey(
          'fk-post-author_id',
          'post',
          'author_id',
          'adminuser',
          'id',
          'CASCADE'
      );
    }

    public function down()
    {
      // drops foreign key for table `poststatus`
        $this->dropForeignKey(
            'fk-post-status',
            'post'
        );

        // drops index for column `status`
        $this->dropIndex(
            'idx-post-status',
            'post'
        );
      $this->dropColumn('post', 'status', $this->integer());

      // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post-author_id',
            'post'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-post-author_id',
            'post'
        );
      $this->dropColumn('post', 'author_id', $this->integer());
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
