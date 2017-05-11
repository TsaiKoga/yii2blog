<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */

    // 添加新属性
    public function attributes() {
      return array_merge(parent::attributes(), ['authorName']);
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['author_id'], 'integer'],
            [['status'], 'integer'],
            [['title', 'content', 'tags', 'create_time', 'update_time', 'authorName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 2],
            'sort' => [
              'defaultOrder' => [
                  'id' => SORT_DESC
              ],
              'attributes' => ['id', 'title'] # 只能排序的字段
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1'); //数据验证不符合，什么都不显示；注释掉则显示全部内容
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'tags' => $this->tags,
            'author_id' => $this->author_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags]);
        $query->join('INNER JOIN', 'Adminuser', 'Adminuser.id = post.author_id');
        $query->andFilterWhere(['like', 'Adminuser.nickname', $this->authorName]);

        // 再次添加排序内容：
        $dataProvider->sort->attributes['authorName'] = [
          'asc' => ['Adminuser.nickname' => SORT_ASC],
          'desc' => ['Adminuser.nickname' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
