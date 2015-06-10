<?php

namespace Neoxygen\NeoClientExtension\Spatial\Command;

use Neoxygen\NeoClient\Command\AbstractCommand;

class SpatialCreateSimplePointLayerCommand extends AbstractCommand
{
    const METHOD = 'POST';

    const PATH = '/db/data/ext/SpatialPlugin/graphdb/addSimplePointLayer';

    public function execute()
    {
        return $this->process(self::METHOD, self::PATH, $this->getBody(), $this->connection);
    }

    private function getBody()
    {
        $indexInfo = array(
            'layer' => 'geom',
            'lat' => 'lat',
            'lon' => 'lon'
        );

        return json_encode($indexInfo);
    }
}