<?php

class m0001_initial 
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
        $SQL = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            status TINYINT DEFAULT 0 NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;
        ";
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
        $SQL = "DROP TABLE IF NOT EXISTS users;";
        $db->pdo->exec($SQL);
    }
}