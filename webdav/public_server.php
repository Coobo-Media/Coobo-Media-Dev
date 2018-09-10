<?php


/**
 * UTC or GMT is easy to work with, and usually recommended for any
 * application.
 */
date_default_timezone_set('UTC');

/**
 * Make sure this setting is turned on and reflect the root url for your WebDAV
 * server.
 *
 * This can be for example the root / or a complete path to your server script.
 */
$baseUri = '/webdav/public_server.php';

/**
 * Database
 *
*/
$pdo = new \PDO('mysql:dbname=coobom_SabreDAV','coobom_SabreDAV','oV3-pp6-3yS-Jzr');
// Throwing exceptions when PDO comes across an error:
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

/**
 * Mapping PHP errors to exceptions.
 *
 * While this is not strictly needed, it makes a lot of sense to do so. If an
 * E_NOTICE or anything appears in your code, this allows SabreDAV to intercept
 * the issue and send a proper response back to the client (HTTP/1.1 500).
 */
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");


// The autoloader
require 'vendor/autoload.php';


$lockBackend = new Sabre\DAV\Locks\Backend\File('data/locks');

// Plugins

$browserPlugin = new Sabre\DAV\Browser\Plugin();
$lockPlugin = new Sabre\DAV\Locks\Plugin($lockBackend);

// Creating the backend

$authBackend = new Sabre\DAV\Auth\Backend\BasicCallBack(function($userName, $password) {

   // check the username and password here, and then just return true or false.
   return ($userName == 'clint' && $password == 'clintz' ? true: false);
   

});

$authPlugin = new Sabre\DAV\Auth\Plugin($authBackend,'SabreDAV');



// Now we're creating a whole bunch of objects
$rootDirectory = new Sabre\DAV\FS\Directory('public');


$server = new Sabre\DAV\Server($rootDirectory);
$server->setBaseUri($baseUri);

//$server->addPlugin($authPlugin);
$server->addPlugin($browserPlugin);
$server->addPlugin($lockPlugin);
$server->addPlugin($authPlugin);



$server->exec();








// Now we're creating a whole bunch of objects
//$rootDirectory = new DAV\FS\Directory('public');



// The server object is responsible for making sense out of the WebDAV protocol
//$server = new DAV\Server($rootDirectory);

// If your server is not on your webroot, make sure the following line has the
// correct information
//$server->setBaseUri($baseUri);

// The lock manager is reponsible for making sure users don't overwrite
// each others changes.
//$lockBackend = new DAV\Locks\Backend\File('data/locks');
//$lockPlugin = new DAV\Locks\Plugin($lockBackend);
//$server->addPlugin($lockPlugin);

// This ensures that we get a pretty index in the browser, but it is
// optional.
//$server->addPlugin(new DAV\Browser\Plugin());

//
//use Sabre\DAV\Auth;

// Creating the backend
//$authBackend = new Auth\Backend\PDO($pdo);

// Creating the plugin. We're assuming that the realm
// name is called 'SabreDAV'.
//$authPlugin = new Auth\Plugin($authBackend,'SabreDAV');

// Adding the plugin to the server
//$server->addPlugin($authPlugin);


//$principalBackend = new Sabre\DAVACL\PrincipalBackend\PDO($pdo);

//new Sabre\DAVACL\PrincipalCollection($principalBackend),


// All we need to do now, is to fire up the server
//$server->exec();