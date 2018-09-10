<?php

namespace MyServer;

use Sabre\DAV\Collection;
use Sabre\DAV\FS;
use Sabre\DAV\Auth\Plugin as AuthPlugin;
use \PDO as PDO;


class MyHomeCollection extends Collection {

    protected $users;
	protected $authPlugin;
	protected $pdo;

    protected $path = 'public';
	
	function __construct(AuthPlugin $authPlugin, PDO $pdo) {

        $this->authPlugin = $authPlugin;
		$this->pdo = $pdo;
		$this->users = $this->getUsers();
		
    }

    function getChildren() {

       $result = array();
       foreach($this->users as $user) {
		   
		   //does the user directory exist?
		   //if not, create it
		   $userDir = $this->path . '/' . $user['username'];
			
			if (!is_dir($userDir)) {
				mkdir($userDir, 0755,true);
			}
			
			//if this is the current user then only allow there directory to be visible
			if( $this->authPlugin->getCurrentUser() == $user['username'] ) {
	
            	$result[] = new FS\Directory($userDir);
	
			}

       }
       return $result;

    }

    function getName() {

        return 'home';

    }
	
	 /**
     * Returns a list of all users
     *
     * @return array|null
     */
    function getUsers() {

        $stmt = $this->pdo->prepare('SELECT username FROM users');
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (!count($result)) return;

        return $result;

    }

}