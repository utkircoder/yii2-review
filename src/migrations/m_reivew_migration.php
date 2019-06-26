<?php
namespace whiteSuit\review\migrations;

use whiteSuit\review\migrations\models\ReviewMigration;
use yii\db\Migration;


class m_reivew_migration extends ReviewMigration
{
    protected $tableName = '{{%reviews}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->defaultValue(NULL),
            'type' => $this->integer()->defaultValue(NULL),
            'session_id' => $this->string()->defaultValue(NULL),
            'name' => $this->string()->defaultValue(NULL),
            'comment' => $this->text(),
            'rating' => $this->float()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addIndexForiegnKey('user_id','id','{{%user}}');
    }

    public function safeDown()
    {
       $this->dropTable($this->tableName);
    }

}
