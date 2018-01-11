<?php

use yii\db\Migration;

/**
 * Handles the creation of table `students`.
 */
class m180111_132441_create_students_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('students', [
            'id'         => $this->primaryKey(),
            'first_name' => $this->string(100),
            'last_name'  => $this->string(100),
            'sex'        => $this->smallInteger(1),
            'group'      => $this->string(5),
            'email'      => $this->string(100)->unique(),
            'points'     => $this->smallInteger(1),
            'birth_year' => $this->smallInteger(1),
            'is_local'   => $this->smallInteger(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('students');
    }
}
