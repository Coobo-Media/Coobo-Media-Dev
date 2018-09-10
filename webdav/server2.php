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
$baseUri = '/webdav/server2.php';

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

// Autoloader
require_once 'vendor/autoload.php';


$authBackend = new Sabre\DAV\Auth\Backend\PDO($pdo);
$principalBackend = new Sabre\DAVACL\PrincipalBackend\PDO($pdo);

$tree = array(
    new MyServer\HomeCollection($principalBackend),
    new Sabre\DAVACL\PrincipalsCollection($principalBackend),
);

$server = new Sabre\DAV\Server($tree);
//$server->setBaseUri($baseUri);

$authPlugin = new Sabre\DAV\Auth\Plugin($authBackend);
$server->addPlugin($authPlugin);

$aclPlugin = new Sabre\DAV\ACL\Plugin();
$server->addPlugin($aclPlugin);

$server->exec();


?>