<?php

namespace Neoxygen\NeoClientExtension\Spatial\Command;

use Neoxygen\NeoClient\Command\AbstractCommand;

class SpatialFindWithinDistance extends AbstractCommand
{
    const METHOD = 'POST';

    const PATH = '/db/data/ext/SpatialPlugin/graphdb/findGeometriesWithinDistance';

    private $x;

    private $y;

    private $distance;

    public function execute()
    {
        return $this->process(self::METHOD, self::PATH, $this->getBody(), $this->connection);
    }

    public function setArguments($x, $y, $distance)
    {
        $this->x = $x;
        $this->y = $y;
        $this->distance = $distance;
    }

    private function getBody()
    {
        $body = array(
            'layer' => 'geom',
            'pointX' => $this->x,
            'pointY' => $this->y,
            'distanceInKm' => $this->distance
        );

        return json_encode($body);
    }

}