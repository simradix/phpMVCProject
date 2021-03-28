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
        $db = \app\core\Application::$app->db;
        $db->pdo->exec();
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
    }
}