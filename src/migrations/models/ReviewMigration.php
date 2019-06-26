<?php


namespace whiteSuit\review\migrations\models;


use yii\db\Migration;

class ReviewMigration extends Migration
{
    protected $tableName = '{{%reviews}}';
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    protected function addIndexForiegnKey($localColumn,$foriegnColumn,$foriegnTable,$deleteType='CASCADE')
    {
        $this->createIndex(
            'idx_' . $this->getTablename($this->tableName) . '_' . $localColumn,
            $this->tableName,
            $localColumn
        );

        $this->addForeignKey(
            'fk_' . $this->getTablename($this->tableName). '_' . $localColumn . '_' . $this->getTablename($foriegnTable) . '_' . $foriegnColumn,
            $this->getTablename($this->tableName),
            $localColumn,
            $foriegnTable,
            $foriegnColumn,
            $deleteType
        );
    }

    private function getTablename($table)
    {
        $table_name = str_replace('{{%', '', $table);
        $table_name = str_replace('}}', '', $table_name);
        return $table_name;
    }

    protected function addIndex($localColumn){
        $this->createIndex(
            'idx_' . $this->getTablename($this->tableName) . '_' . $localColumn,
            $this->tableName,
            $localColumn
        );
    }
}