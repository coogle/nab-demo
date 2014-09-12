<?php

namespace NAB\Loader\Parser;

use NAB\Model\Item;
use Illuminate\Support\Collection;

class NL extends AbstractParser
{
    /**
     * Parse the input data, return an array of data
     * @param string $data
     * @return array
     */
    public function parse($data)
    {
        $lines = explode("\n", $data);
        
        $retval = [];
        
        for($i = 0; $i < count($lines); $i += 4) {
            $itemObj = new Item();
            $itemObj->setId($lines[$i]);
            $itemObj->setName($lines[$i+1]);
            $itemObj->setQuantity($lines[$i+2]);
            $itemObj->setCategories($this->parseCategories($lines[$i + 3]));
            
            if($itemObj->isValid() === true) {
                $retval[] = $itemObj;
            }
        }
        
        return $this->filterById(new Collection($retval));
    }
}