<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property string $create_time
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $user_id
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_time'], 'safe'],
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['email', 'url'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Commentstatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'create_time' => '创建时间',
            'email' => '邮箱',
            'url' => 'Url',
            'post_id' => '文章',
            'user_id' => '作者',
            'status' => '状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getBeginning()
    {
      $tmpStr = strip_tags($this->content);
      $tmpLen = mb_strlen($tmpStr);
      return mb_substr($tmpStr, 0, 10, 'utf-8').(($tmpLen > 10)? '...' : '');
    }

    public function getStatus0()
    {
      return $this->hasOne(Commentstatus::className(), ['id'=>'status']);
    }

    public function approve()
    {
      $this->status = 2;
      return ($this->save() ? true : false);
    }

    public static function getPendingCommentCount()
    {
      return Comment::find()->where(['status' => 1])->count();
    }

    public function beforeSave($insert)
    {
      if (parent::beforeSave($insert)) {
        if ($insert) {
          $this->create_time = time();
        }
        return true;
      }
      return false;
    }

    public static function findRecentComments($limit=10)
    {
      return Comment::find()->where(['status' => 2])->orderBy('create_time DESC')->limit($limit)->all();
    }
}
