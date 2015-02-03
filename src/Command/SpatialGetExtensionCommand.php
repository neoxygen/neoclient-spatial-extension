<?php

namespace Neoxygen\NeoClientExtension\Spatial\Command;

use Neoxygen\NeoClient\Command\AbstractCommand;

class SpatialGetExtensionCommand extends AbstractCommand
{
    const METHOD = 'GET';

    const PATH = '/db/data/ext/SpatialPlugin';

    public function execute()
    {
        return $this->process(self::METHOD, self::PATH, null, $this->connection);
    }
}