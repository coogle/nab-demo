<?php

namespace NAB;

use NAB\Loader\LoaderInterface;
use Illuminate\Support\Collection;

class Demo
{
    /**
     * @var LoaderInterface
     */
    protected $_inputDriver;
    
    /**
     * @var Illuminate\Support\Collection
     */
    protected $_data;
    
    /**
     * Get the data for this input driver, if it hasn't been loaded
     * yet load and parse it.
     * 
     * @throws \Exception
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        if(!$this->_data instanceof Collection) {
            if(!$this->getInputDriver() instanceof LoaderInterface) {
                throw new \Exception("You must provide an Input Driver");
            }
        
            $this->setData($this->getInputDriver()->load());
        }
        
        return $this->_data;
    }
    
    /**
     * Set the collection data
     * 
     * @param \Illuminate\Support\Collection $data
     * @return \NAB\Demo
     */
    public function setData(Collection $data) 
    {
        $this->_data = $data;
        return $this;
    }
    
    /**
     * Set the Input Driver to use
     * 
     * @param LoaderInterface $driver
     * @return \NAB\Demo
     */
    public function setInputDriver(LoaderInterface $driver) {
        $this->_inputDriver = $driver;
        return $this;
    }
    
    /**
     * Get the Input Driver
     * 
     * @return \NAB\Loader\LoaderInterface
     */
    public function getInputDriver()
    {
        return $this->_inputDriver;
    }
    
    /**
     * Find an item based on ID
     * @param string $id
     * @return \Illuminate\Support\Collection the results
     */
    public function findById($id)
    {
        $result = $this->getData()->filter(function($item) use ($id) {
            return $item->getId() == $id;
        });
             
        return $result;
    }
    
    /**
     * Find all the items
     * 
     * @return \Illuminate\Support\Collection the results
     */
    public function findAll()
    {
        return $this->getData();
    }
    
    /**
     * Find the items by category
     * 
     * @param string $searchCategory
     * @return \Illuminate\Support\Collection the results
     */
    public function findByCategory($searchCategory)
    {
        $result = $this->getData()->filter(function($item) use ($searchCategory) {
            $result = $item->getCategories()->filter(function($category) use ($searchCategory) {
                return $category == $searchCategory;
            });
            
            return ($result->count() > 0);
        });
        
        return $result;
    }
    
}