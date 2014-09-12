<?php

namespace NAB\Model;

use Illuminate\Support\Collection;

class Item
{
    /**
     * @var string
     */
    protected $_id;
    
    /**
     * @var string
     */
    protected $_name;
    
    /**
     * @var integer
     */
    protected $_quantity;
    
    /**
     * @var \Illuminate\Support\Collection;
     */
    protected $_categories;
    
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'quantity' => $this->getQuantity(),
            'categories' => $this->getCategories()->toArray()
        );
    }
    /**
     * @return string the $_id
     */
    public function getId()
    {
        return $this->_id;
    }

	/**
     * @return string the $_name
     */
    public function getName()
    {
        return $this->_name;
    }

	/**
     * @return integer the $_quantity
     */
    public function getQuantity()
    {
        return $this->_quantity;
    }

	/**
     * @return \Illuminate\Support\Collection the $_categories
     */
    public function getCategories()
    {
        return $this->_categories;
    }

	/**
     * @param string $_id
     */
    public function setId($_id)
    {
        $this->_id = $_id;
    }

	/**
     * @param string $_name
     */
    public function setName($_name)
    {
        $this->_name = $_name;
    }

	/**
     * @param number $_quantity
     */
    public function setQuantity($_quantity)
    {
        $this->_quantity = $_quantity;
    }

	/**
     * @param \Illuminate\Support\Collection; $_categories
     */
    public function setCategories($_categories)
    {
        $this->_categories = $_categories;
    }

	public function __construct()
    {
        $this->_categories = new Collection(); 
    }
    
    /**
     * Validates the model against its validation rules and values.
     * Returns boolean true if the model was valid, or a collection
     * of messages of what was invalid if not valid.
     * 
     * @return boolean|array
     */
    public function isValid()
    {
        $validator = \Validator::make(
            $this->toArray(),
            static::getValidationRules()
        );
        
        if($validator->fails()) {
            return $validator->messages();
        }
        
        return true;
    }
    
    /**
     * Returns the validation rules for the model
     * 
     * @return array
     */
    static protected function getValidationRules()
    {
        return array(
            'id' => 'required|id',
            'name' => 'required',
            'quantity' => 'required|integer|min:1'
        );
    }
}