<?php

namespace NAB\Validator;

class Validator extends \Illuminate\Validation\Validator
{
    /**
     * A validator used to validate the structure of an item ID
     * 
     * @param unknown $attribute
     * @param unknown $value
     * @param unknown $params
     * @return number
     */
    public function validateId($attribute, $value, $params)
    {
        $regEx = "/[0-9]{2}-[A-Z]{2}-[A-Z]{2}[0-9]{2}/i";
        
        return preg_match($regEx, $value);
    }
    
}