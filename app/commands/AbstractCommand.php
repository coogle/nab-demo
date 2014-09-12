<?php

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

abstract class AbstractCommand extends Command
{
    /**
     * Render the output results to the console
     * 
     * Options
     *  - prefix : The string to prepend to all output
     *  - show_categories : true and we will render the categories for an item
     *  
     * @param Collection $items
     * @param array $options 
     */
    protected function render(Collection $items, $options = array())
    {
        $defaults = array(
            'prefix' => '',
            'show_categories' => true
        );
        
        $options += $defaults;
        if($items->count() == 0) {
            $this->info("No results found.");
            return;
        }
         
        foreach($items as $item) {
            $this->info("{$options['prefix']}{$item->getId()} {$item->getName()} ({$item->getQuantity()})");
             
            if($options['show_categories']) {
                foreach($item->getCategories() as $cat) {
                    $this->info("{$options['prefix']}- $cat");
                }
            }
            $this->info("");
        }
         
    }
}