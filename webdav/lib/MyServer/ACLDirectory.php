<?php

namespace MyServer;

use Sabre\DAV\Exception\NotFound;

class ACLDirectory extends Sabre\DAV\FS\Directory implements Sabre\DAVACL\IACL {

    use ACLTrait;

    function __construct($path, $owner) {

        parent::__construct($path);
        $this->owner = $owner;

    }

    function getChild($name) {

        $path = $this->path . '/' . $name;

        if (!file_exists($path)) throw new NotFound('File with name ' . $path . ' could not be located');

        if (is_dir($path)) {

            return new ACLDirectory($path);

        } else {

            return new ACLFile($path);

        }
    }

    function getChildren() {

        $result = array();
        foreach(scandir($this->path) as $file) {

            if ($file==='.' || $file==='..') {
                continue;
            }
            $result[] = $this->getChild($file);

        }

        return $result;

    }

}

class ACLFile extends Sabre\DAV\FS\File implements Sabre\DAVACL\IACL {

    use ACLTrait;

    function __construct($path, $owner) {

        parent::__construct($path);
        $this->owner = $owner;

    }

}
