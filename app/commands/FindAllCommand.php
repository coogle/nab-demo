<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use NAB\Demo;

class FindAllCommand extends AbstractCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'find-all';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Find all items';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
	    $fileLoader = new \NAB\Loader\Driver\File();
	    
	    $fileLoader->setOptions(array(
	        'file' => $this->argument('filename')
	    ));
	    
	    $demo = new Demo();
	    $demo->setInputDriver($fileLoader);
	    $result = $demo->findAll();
	    
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
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
