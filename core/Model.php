<?php
namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    
    public array $errors = [];

    /**
     * Load data submited by the client
     *
     * Check if the keys from $data are a declared property inside a Model
     * and then assign the value to that property
     *
     * @param Array $data Description
     * @return void
     **/
    public function loadData(Array $data): void
    {
        foreach($data as $fieldName => $fData) {
            if (property_exists($this, $fieldName)) {
                $this->{$fieldName} = $fData;
            }
        }
    }

    /**
     * Return an assoc-array containing the validate rules
     * 
     * 'ruleName' => [ self::RULE_NAME ]
     * or
     * 'ruleName' => [ self::RULE_NAME, 'param'=>Value ]
     * 'password' => [ self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8] ]
     */
    abstract public function rules(): array;


    /**
     * Check if the client submited data is valid 
     *
     * Load the validation rules implemented for each field inside the rules() method
     * Check if each field meets the constraints.
     * If not, call the addError() method and pass the field name and the RULE as param.
     *
     * @return bool // returns true if all fields passes the rules
     **/
    public function validate(): bool
    {
        foreach ($this->rules() as $fieldName => $rules) {
            $field = $this->{$fieldName};

            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                
                if ($ruleName === self::RULE_REQUIRED && !$field) {
                    $this->addError($fieldName, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($field, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($fieldName, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($field) < $rule['min']) {
                    $this->addError($fieldName, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($field) > $rule['max']) {
                    $this->addError($fieldName, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $field !== $this->{$rule['match']}) {
                    $this->addError($fieldName, self::RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * Load validation error into error array.
     *
     * 
     *
     * @param String $attr Description
     * @param String $ruleName Description
     * @param Array $params Description
     * @return void
     **/
    public function addError(String $fieldName, String $ruleName, Array $params = []): void
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$fieldName][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}'           
        ];
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasError($attr) {
        return isset($this->errors[$attr]);
    }

    public function getFirstError($attr) {
        if (isset($this->errors[$attr][0])) {
            return $this->errors[$attr][0];
        } else {
            return null;
        }
    }

}