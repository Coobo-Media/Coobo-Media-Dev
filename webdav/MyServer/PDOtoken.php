<?php
namespace Sabre\DAV\Auth\Backend;

include('AbstractToken.php');

/**
 * This is an authentication backend that uses a file to manage passwords.
 *
 * The backend file must conform to Apache's htdigest format
 *
 * @copyright Copyright (C) 2007-2015 fruux GmbH (https://fruux.com/).
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
class PDOtoken extends AbstractToken{

    /**
     * Reference to PDO connection
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * PDO table name we'll be using
     *
     * @var string
     */
    protected $tableName;


    /**
     * Creates the backend object.
     *
     * If the filename argument is passed in, it will parse out the specified file fist.
     *
     * @param PDO $pdo
     * @param string $tableName The PDO table name to use
     */
    public function __construct(\PDO $pdo, $tableName = 'users') {

        $this->pdo = $pdo;
        $this->tableName = $tableName;

    }

    /**
     * Returns a username for a hash.
     *
     * @param string $hash
     * @return string|null
     */
    public function getTokenUser($hash) {

        $stmt = $this->pdo->prepare('SELECT username FROM '.$this->tableName.' WHERE digesta1 = ?');
        $stmt->execute(array($hash));
        $result = $stmt->fetchAll();

        if (!count($result)) return;

        return $result[0]['username'];

    }

}