<?php

namespace MyServer;

use Sabre\DAVACL\AbstractPrincipalCollection;

class HomeCollection extends AbstractPrincipalsCollection {

    protected $path = '/opt/sabredav/userdir/';

    function getName() {

        return 'home';

    }

    /**
     * This method returns a node for a principal.
     *
     * The passed array contains principal information, and is guaranteed to
     * at least contain a uri item. Other properties may or may not be
     * supplied by the authentication backend.
     *
     * @param array $principalInfo
     * @return IPrincipal
     */
    function getChildForPrincipal(array $principalInfo) {

        $principalUri = $principalInfo['uri'];
        $principalBaseName = basename($principalInfo['uri']); // will contain something like 'alice'.

        $principalDataPath = $this->path . $principalBaseName;
        if (!is_dir($principalDataPath)) {
            mkdir($principalDataPath);
        }

        return new AclDirectory($this->path. $principalBaseName, $principalUri);

    }

}