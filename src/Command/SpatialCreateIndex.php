<?php

namespace Neoxygen\NeoClientExtension\Spatial\Command;

use Neoxygen\NeoClient\Command\AbstractCommand;

class SpatialCreateIndex extends AbstractCommand
{
    const METHOD = 'POST';

    const PATH = '/db/data/index/node/';

    public function execute()
    {
        return $this->process(self::METHOD, self::PATH, $this->getBody(), $this->connection);
    }

    private function getBody()
    {
        $indexInfo = array(
            'name' => 'geom',
            'config' => array(
                'provider' => 'spatial',
                'geometry_type' => 'point',
                'lat' => 'lat',
                'lon' => 'lon'
            )
        );

        return json_encode($indexInfo);
    }
}