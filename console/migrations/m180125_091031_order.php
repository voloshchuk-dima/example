<?php

use yii\db\Migration;

class m180125_091031_order extends Migration
{
    public function up()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
            'domain' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'lang_code' => $this->string(5)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }
    
    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
