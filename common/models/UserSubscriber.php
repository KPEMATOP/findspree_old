<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 12.03.15
 * Time: 12:20
 */

namespace common\models;

use yii\behaviors\TimestampBehavior;
use common\models\Wall\SubscribeUser;

/**
 * Class UserSubscriber
 * @package common\models
 * @property $user_id int
 * @property $subscriber_id int
 */
class UserSubscriber extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => false
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_subscriber';
    }

    public function fields()
    {
        return  ['user','subscriber'];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	public function getSubscriber()
	{
		return $this->hasOne(User::className(), ['id' => 'subscriber_id']);
	}
    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        $wall = new Wall();
        $wall->setData(new SubscribeUser([
            'to' => $this->user_id,
            'from' => $this->subscriber_id,
            'status' => SubscribeUser::STATUS_UNSUBSCRIBE
        ]));
        $wall->publishTo(new WallPost(['target_type' => WallPost::TARGET_TYPE_USER, 'target_id' => $this->user_id, 'personal' => true]));
        $wall->publishTo(new WallPost(['target_type' => WallPost::TARGET_TYPE_USER, 'target_id' => $this->subscriber_id, 'personal' => false]));
        $wall->save();
    }

    public function afterSave($insert, $attr)
    {
        parent::afterSave($insert, $attr);
        $wall = new Wall();
        $wall->setData(new SubscribeUser([
            'to' => $this->user_id,
            'from' => $this->subscriber_id,
            'status' => SubscribeUser::STATUS_SUBSCRIBE
        ]));
        $wall->publishTo(new WallPost(['target_type' => WallPost::TARGET_TYPE_USER, 'target_id' => $this->user_id, 'personal' => true]));
        $wall->publishTo(new WallPost(['target_type' => WallPost::TARGET_TYPE_USER, 'target_id' => $this->subscriber_id, 'personal' => false]));
        $wall->save();
    }
}