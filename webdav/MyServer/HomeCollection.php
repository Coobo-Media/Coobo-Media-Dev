<?php

namespace MyServer;

use Sabre\DAV\Collection;
use Sabre\DAV\FS;
use Sabre\DAV\Auth\Plugin as AuthPlugin;

class HomeCollection extends Collection {

    protected $users = array('admin','clint');
	protected $authPlugin;

    protected $path = 'public';
	
	function __construct(AuthPlugin $authPlugin) {

        $this->authPlugin = $authPlugin;

    }

    function getChildren() {

       $result = array();
       foreach($this->users as $user) {
		   
		   //does the user directory exist?
		   //if not, create it
		   $userDir = $this->path . '/' . $user;
			
			if (!is_dir($userDir)) {
				mkdir($userDir, 0755,true);
			}
			
			//if this is the current user then only allow there directory to be visible
			if( $this->authPlugin->getCurrentUser() == $user ) {
	
            	$result[] = new FS\Directory($userDir);
	
			}

       }
       return $result;

    }

    function getName() {

        return 'home';

    }
	
	
	
	

}