<?php

namespace Neoxygen\NeoClientExtension\Spatial;

use Neoxygen\NeoClient\Extension\AbstractExtension;

class SpatialExtension extends AbstractExtension
{
    public static function getAvailableCommands()
    {
        return array(
            'spatial_get_extension' => array(
                'class' => 'Neoxygen\NeoClientExtension\Spatial\Command\SpatialGetExtensionCommand'
            ),
            'spatial_create_index' => array(
                'class' => 'Neoxygen\NeoClientExtension\Spatial\Command\SpatialCreateIndex'
            ),
            'spatial_add_node_to_index' => array(
                'class' => 'Neoxygen\NeoClientExtension\Spatial\Command\SpatialAddNodeToIndexCommand'
            )
        );
    }

    public function getSpatialExtension($conn = null)
    {
        $command = $this->invoke('spatial_get_extension', $conn);
        $response = $command->execute();

        //print_r($response);
    }

    public function createSpatialIndex($conn = null)
    {
        $command = $this->invoke('spatial_create_index', $conn);
        $response = $command->execute();

        //print_r($response);
    }

    public function addNodeToSpatialIndex($nodeId, $conn = null)
    {
        $nodeUri = $this->connectionManager->getConnection($conn)->getBaseUrl().'/db/data/node/'. (int) $nodeId;
        $command = $this->invoke('spatial_add_node_to_index', $conn);
        $command->setArguments($nodeUri);

        $response = $command->execute();

        print_r($response);
    }
}