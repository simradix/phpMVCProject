<?php
namespace app\core;

use PDO;
use PDOStatement;

/**
 * Database model class
 */
abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function save() 
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map( fn($attr) => ":$attr", $attributes );

        $statement = self::prepare("
        INSERT INTO $tableName (" .implode(', ', $attributes). ")
            VALUES(" .implode(', ', $params). ")
        ");

        foreach ($attributes as $attribute) {
            $statement->bindParam(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public static function prepare($sql): PDOStatement|bool
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
