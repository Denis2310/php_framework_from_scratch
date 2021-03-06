<?php
namespace Core;

/**
* Class View - for rendering view files
*/
class View
{
	/**
	* Render View file 
	*
	* @param string $view View file to require
	* @param array $args Array of variables to pass to view
	*
	* @return void
	*/
	public static function render($view, $args = [])
	{	
		extract($args, EXTR_SKIP);

		$file = '../App/Views/' . $view;

		if (is_readable($file)) {
			require $file;			
		} else {
			throw new \Exception("file '$file' not found.");			
		}
	}

	/**
	* Render View file with Twig template
	*
	* @param string $view View file to require
	* @param array $args Array of variables to pass to view
	*
	* @return void
	*/
	public static function renderTemplate($view, $args = [])
	{
		static $twig = null;

		if ($twig === null) {
			$loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/App/Views/');
			$twig = new \Twig_Environment($loader);
		}

		echo $twig->render($view, $args);
	}
}