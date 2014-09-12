<?php

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use NAB\Demo;

class GroupByCategoryCommand extends AbstractCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'group-by-category';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Return a list grouped by category';

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
	    
	    $results = $demo->findAll();
	    
	    $categories = [];
	    
	    foreach($results as $item) {
	        foreach($item->getCategories() as $category) {
	            if(!in_array($category, $categories)) {
	                $categories[] = $category;
	            }
	        }
	    }
	    
	    foreach($categories as $category) {
	        $this->info($category);
	        $result = $demo->findByCategory($category);
	        $this->render($result, array(
	            'prefix' => "\t",
	            'show_categories' => false
	        ));
	    }
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
