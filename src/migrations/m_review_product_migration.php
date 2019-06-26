<?php


namespace whiteSuit\review\migrations;

use whiteSuit\review\migrations\models\ReviewMigration;

class m_review_product_migration extends ReviewMigration
{
    protected $tableName = '{{%product_reviews}}';
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
            'product_id' => $this->integer()->notNull(),
            'sort'=>$this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->addIndexForiegnKey('review_id','id','{{%reviews}}');
        $this->addIndexForiegnKey('product_id','id','{{%product}}');
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}