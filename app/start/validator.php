<?php

use NAB\Validator\Validator as NABValidator;

Validator::resolver(function($translator, $data, $rules, $messages) {
    $messages['id'] = "Invalid ID";
    return new NABValidator($translator, $data, $rules, $messages);
});