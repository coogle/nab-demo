<?php

namespace NAB\Loader\Parser;

use NAB\Model\Item;
use Illuminate\Support\Collection;

class CSV extends AbstractParser
{
    /**
     * Parse the input data, return an array of data
     * @param string $data
     * @return array
     */
    public function parse($data)
    {
        $lines = explode("\n", $data);

        $retval = array();
        
        foreach($lines as $idx => $line) {
            $lineCol = str_getcsv($line);
            
            $itemObj = new Item();
            $itemObj->setId($lineCol[0]);
            $itemObj->setName($lineCol[1]);
            $itemObj->setQuantity($lineCol[2]);
            $itemObj->setCategories($this->parseCategories($lineCol[3]));
            
            $validation = $itemObj->isValid();
            
            if($validation === true) {
                $retval[] = $itemObj;
            }
        }
        
        $retval = new Collection($retval);
        
        return $this->filterById($retval);
    }
}