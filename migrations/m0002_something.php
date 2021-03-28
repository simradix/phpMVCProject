<?php

class m0002_something 
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
        echo "$className - "."Applying migrations" . PHP_EOL;
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