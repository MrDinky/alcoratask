<?php

use yii\db\Migration;

class m170517_222441_create_alcora_module_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%alcora_user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'age' => $this->integer(2)->notNull(),
            'city' => $this->text()->notNull(),
            'height' => $this->integer(3)->notNull(),
            'weight' => $this->integer(3)->notNull(),
            'english' => "enum('no','basic','middle','high','excellent') NOT NULL DEFAULT 'no'",
            'technique' => "enum('no','camera','camera_comp') NOT NULL DEFAULT 'no'",
        ]);

        $this->createTable('alcora_user_photo', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'photo' => $this->string()->notNull(),
        ]);

        $this->createIndex('in_alcora_user_photo$user_id', '{{%alcora_user_photo}}', 'user_id');
        $this->addForeignKey('fk_alcora_user_photo$user_id-alcora_user$id', '{{%alcora_user_photo}}', 'user_id', '{{%alcora_user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_alcora_user$id-alcora_user_photo$user_id', '{{%alcora_user}}');
        $this->dropTable('{{%alcora_user_photo}}');
        $this->dropTable('{{%alcora_user}}');
    }
}
