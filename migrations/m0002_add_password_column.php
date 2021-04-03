<?php

class m0002_add_password_column
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function up()
    {
        $className = self::class;
        echo "$className - "."up migrations" . PHP_EOL;
        

        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;";
        $db->pdo->exec($SQL);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function down()
    {
        $className = self::class;
        echo "$className - "."down migrations" . PHP_EOL;

        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($SQL);
    }
}