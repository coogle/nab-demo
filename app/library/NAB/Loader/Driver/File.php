<?php

namespace NAB\Loader\Driver;

use Illuminate\Filesystem\FileNotFoundException;
use NAB\Loader\Parser\CSV;
use NAB\Loader\Parser\NL;

/**
 * Driver for reading in .csv and .nl files for data
 */
class File implements \NAB\Loader\LoaderInterface
{
    protected $_options;
    
    /**
     * Return the parser used to parse based on file extension
     * 
     * @param string $ext
     * @throws \Exception
     * @return \NAB\Loader\Parser\CSV|\NAB\Loader\Parser\NL
     */
    protected function getParserForExtension($ext)
    {
        switch($ext) {
            case 'csv':
                return new CSV();
            case 'nl':
                return new NL();
            default:
                throw new \Exception("No parser available for extension type");
        }
    }
    
    /**
     * Return a collection of Item objects from parse results
     * 
     * @see \NAB\Loader\LoaderInterface::load()
     */
    public function load()
    {
        $extension = pathinfo($this->_options['file'], PATHINFO_EXTENSION);
        
        $parser = $this->getParserForExtension($extension);
        
        $data = file_get_contents($this->_options['file']);
        
        $results = $parser->parse($data);
        
        return $results;
    }
    
    /**
     * Set the options for this driver
     * 
     * @see \NAB\Loader\LoaderInterface::setOptions()
     */
    public function setOptions(array $options)
    {
        $defaults = array(
            'file' => null  
        );
        
        $options += $defaults;
        
        if(empty($options['file'])) {
            throw new \Exception("Data file not specified");
        }
        
        $options['file'] = realpath($options['file']);
        
        if(!file_exists($options['file']) || !is_readable($options['file'])) {
            throw new FileNotFoundException("Could not locate or read {$options['file']}");
        }
        
        $this->_options = $options;
    }
}
