<?php


namespace whiteSuit\review\migrations;

use whiteSuit\review\migrations\models\ReviewMigration;

class m_review_advert_migration extends ReviewMigration
{
    protected $tableName = '{{%advert_reviews}}';
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
            'review_id' => $this->integer()->notNull(),
            'advert_id' => $this->integer()->notNull(),
            'sort'=>$this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addIndexForiegnKey('review_id','id','{{%reviews}}');
        $this->addIndexForiegnKey('advert_id','id','{{%advert}}');
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}