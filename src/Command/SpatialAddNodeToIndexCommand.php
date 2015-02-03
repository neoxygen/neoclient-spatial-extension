<?php

namespace Neoxygen\NeoClientExtension\Spatial\Command;

use Neoxygen\NeoClient\Command\AbstractCommand;

class SpatialAddNodeToIndexCommand extends AbstractCommand
{
    const METHOD = 'POST';

    const PATH = '/db/data/ext/SpatialPlugin/graphdb/addNodeToLayer';

    private $nodeUri;

    public function execute()
    {
        return $this->process(self::METHOD, self::PATH, $this->getBody(), $this->getConnection());
    }

    public function setArguments($nodeUri)
    {
        $this->nodeUri = (string) $nodeUri;
    }

    private function getBody()
    {
        $info = array(
            'layer' => 'geom',
            'node' => $this->nodeUri
        );

        return json_encode($info);
    }
}