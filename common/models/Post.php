<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $create_time
 * @property string $update_time
 * @property integer $author_id
 * @property integer $status
 *
 * @property User $author_id
 * @property Poststatus $status
 *
 * @property Comment[] $comments
 * @property Poststatus $status0
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['title', 'content', 'status', 'author_id'], 'required'],
          [['content', 'tags'], 'string'],
          [['status', 'author_id'], 'integer'],
          [['title'], 'string', 'max' => 128],
          [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
          [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
            'status' => '状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    // 这里'id'=>'name' id是指poststatus的id指向post的status字段
    public function getStatus0()
    {
      return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }

    public function getAuthor() {
      return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }
}
