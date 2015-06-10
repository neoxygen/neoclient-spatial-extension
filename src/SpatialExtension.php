<?php

namespace Neoxygen\NeoClientExtension\Spatial;

use Neoxygen\NeoClient\Extension\AbstractExtension;
use Neoxygen\NeoClient\Formatter\Node,
    Neoxygen\NeoClient\Formatter\Response as ResponseFormat,
    Neoxygen\NeoClient\Formatter\Result;

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
            ),
            'spatial_find_nodes_within_distance' => array(
                'class' => 'Neoxygen\NeoClientExtension\Spatial\Command\SpatialFindWithinDistance'
            ),
            'spatial_add_simple_point_layer' => array(
                'class' => 'Neoxygen\NeoClientExtension\Spatial\Command\SpatialCreateSimplePointLayerCommand'
            )
        );
    }

    /**
     * Returns the root spatial extension api response
     *
     * @param null $conn
     * @return array|ResponseFormat|string
     */
    public function getSpatialExtension($conn = null)
    {
        $command = $this->invoke('spatial_get_extension', $conn);
        $response = $command->execute();

        return $this->handleHttpResponse($response);
    }

    /**
     * Creates a spatial index
     *
     * @param null $conn
     * @return array|ResponseFormat|string
     */
    public function createSpatialIndex($conn = null)
    {
        $command = $this->invoke('spatial_create_index', $conn);
        $response = $command->execute();

        return $this->handleHttpResponse($response);
    }

    public function createSimplePointLayer($conn = null)
    {
        $command = $this->invoke('spatial_add_simple_point_layer');
        $response = $command->execute();

        return $this->handleHttpResponse($response);
    }

    /**
     * Add a node to the spatial index
     *
     * @param $nodeId
     * @param null $conn
     * @return array|ResponseFormat|string
     */
    public function addNodeToSpatialIndex($nodeId, $conn = null)
    {
        $nodeUri = $this->connectionManager->getConnection($conn)->getBaseUrl().'/db/data/node/'. (int) $nodeId;
        $command = $this->invoke('spatial_add_node_to_index', $conn);
        $command->setArguments($nodeUri);

        $response = $command->execute();

        return $this->handleHttpResponse($response);
    }

    /**
     * find nodes within a distance in kilometers
     *
     * @param $x
     * @param $y
     * @param int $distanceInKm
     * @param null $conn
     * @return ResponseFormat
     */
    public function findNodesWithinDistance($x, $y, $distanceInKm = 50, $conn = null)
    {
        $command = $this->invoke('spatial_find_nodes_within_distance', $conn);
        $command->setArguments(floatval($x), floatval($y), (int) $distanceInKm);

        $response = $command->execute();

        return $this->formatResult($this->handleHttpResponse($response));
    }

    /**
     * Format spatial api response result
     *
     * @param $response
     * @return ResponseFormat
     */
    private function formatResult($response)
    {
        $responseFormat = new ResponseFormat();
        $result = new Result();
        $i = 0;
        foreach ($response->getBody() as $found) {
            $node = new Node($found['metadata']['id'], $found['metadata']['labels'], $found['data']);
            $result->addNode($node);
        }
        $responseFormat->addResult($result);

        return $responseFormat;
    }
}