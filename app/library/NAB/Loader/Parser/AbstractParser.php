<?php

namespace NAB\Loader\Parser;

use Illuminate\Support\Collection;

abstract class AbstractParser
{
    /**
     * Parse out the categories of an item
     * 
     * @param string $data
     * @return \Illuminate\Support\Collection
     */
    public function parseCategories($data)
    {
        $categories = explode(';', $data);
        
        $retval = [];
        
        foreach($categories as $val) {
            if(!empty($val)) {
                $retval[] = $val;
            }
        }
        
        return new Collection($retval);
    }
    
    /**
     * Filter out duplicate items from a collection
     * 
     * @param Collection $results
     * @return \Illuminate\Support\Collection filtered results
     */
    public function filterById(Collection $results)
    {
        $ids = [];
        
        return $results->filter(function($item) use (&$ids) {
            $itemId = $item->getId();
            
            if(!empty($itemId) && !in_array($itemId, $ids)) {
                $ids[] = $itemId;
                return true;
            }
            
            return false;
        });
        
    }
}