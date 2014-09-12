<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use NAB\Demo;

class FindByCategoryCommand extends AbstractCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'find-by-category';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Find by a specific category';

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
	    
	    $searchCategory = $this->argument('category');
	    
	    $demo = new Demo();
	    $demo->setInputDriver($fileLoader);
	    $result = $demo->findByCategory($searchCategory);
	    
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
		    array('category', InputArgument::REQUIRED, 'The category'),
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
