<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use NAB\Demo;

class FindByIdCommand extends AbstractCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'find-by-id';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Find an item by ID';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
	    $fileLoader = new \NAB\Loader\Driver\File();
	    
	    $id = $this->argument('id');
	    
	    $fileLoader->setOptions(array(
	        'file' => $this->argument('filename')
	    ));
	    
	    $demo = new Demo();
	    $demo->setInputDriver($fileLoader);
	    $result = $demo->findById($id);
	    
	    if($result->count() > 1) {
	        $this->error("More than one item found with id '$id'");
	        return;
	    }
		
	    return $this->render($result);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		    array('filename', InputArgument::REQUIRED, 'The input file'),
		    array('id', InputArgument::REQUIRED, 'Input ID to find')
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
