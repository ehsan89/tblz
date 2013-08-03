<?php

namespace Factory\UtilityBundle\Utils;


use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Util {

	protected $container;
	
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
	
	/**
	 * Check if the user is authenticated
	 */
	public function isAuthenticated(){
		$securityContext = $this->container->get('security.context');
		return $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') || $securityContext->isGranted('IS_AUTHENTICATED_FULLY');
	}
	
	/**
	 * Check if the user is authenticated has the ADMIN_ROLE
	 */
	public function isCurrentUserAdmin(){
		$securityContext = $this->container->get('security.context');
		return $securityContext->isGranted('SUPER_ADMIN_ROLE') || $securityContext->isGranted('ADMIN_ROLE');
	}
	
	/**
	 * Returns the current user
	 */
	public function getCurrentUser(){
		return $this->container->get('security.context')->getToken()->getUser();
	}
	
	/**
	 * Copies a folder and contents recursively 
	 * @param string $src
	 * @param string $dst
	 */
	public static function recursive_copy_dir($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					self::recursive_copy_dir($src . '/' . $file, $dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
	
	/**
	 * Removes a directory and its contents
	 * @param string $dir
	 */
	public static function recursive_remove_dir($dir) {
		if(is_dir($dir)) {
			foreach(glob($dir . '/*') as $file) {
				if(is_dir($file)) self::recursive_remove_dir($file); else unlink($file);
			} rmdir($dir);
		}
	}
}