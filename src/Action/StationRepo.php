<?php

namespace App\Action;

use App\Domain\Entity\Station;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\Common\Collections\ArrayCollection;
use App\Domain\Station\StationRepoInterface;


class StationRepo implements StationRepoInterface
{
    /**
     *
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;

    /**
     * Undocumented variable
     *
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;
    const DISTANCE = 100;

    public function __construct(HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * Undocumented function
     *
     * @param string $collectionName
     * @param string $searchValue
     * @param string $queryBy
     * @return array<Station>
     */
    public function getStationsByFilters(array $position, string $collectionName, string $searchValue, string $queryBy, ?string $fielToFilter, ?string $filterValue): array
    {
        $url =  $this->createURL($position, $collectionName, $searchValue, $queryBy, $fielToFilter, $filterValue);
        $response = $this->client->request(
            'GET',
            $url,
            [
                'headers' => ['x-typesense-api-key' => $_ENV['TYPESENSE_SECRET']]
            ]
        );

        $dataArray = json_decode($response->getContent(), true);
        if ($dataArray['hits'] == null) {
            throw new HttpException(401, 'error serializeStation: key hits not exists');
        }
        $result = $this->serializeStation($dataArray['hits'], 'document');
        return $result;
    }

    /**
     * get all station eletric 
     *
     * @return array<Station>
     */
    public function getAllStations(): array
    {
        $data = $this->createPayloadRequest();
        $response = $this->client->request(
            'POST',
            $_ENV['TYPESENSE_URL'] . 'multi_search',
            [
                'headers' => [
                    'x-typesense-api-key' => $_ENV['TYPESENSE_SECRET'],
                    'Content-Type' => 'application/json'
                ],
                'json' => $data
            ]
        );
        $result = [];
        foreach ($response->toArray()['results'] as $value) {
            foreach ($value['hits'] as $hit) {
                $result[] = $hit['document'];
            }
        }
        $stations = $this->serializeStation($result);
        return $stations;
    }

    /**
     * generate data request
     *
     * @return array
     */
    private function createPayloadRequest(): array {
        $data =  [
            'searches' => 
                [
                    [
                        'collection' => 'stations',
                        'q' => '*',
                        'page' => 1,
                        'per_page' => 250
                    ]
                ]
        ];
        
        for ($i=2; $i < (4346/250); $i++) { 
            $dataSet = 
            [
                'collection' => 'stations',
                'q' => '*',
                'page' => $i,
                'per_page' => 250
            ];
            \array_push($data['searches'], $dataSet);
        }
        return $data;
    }

    private function createURL(array $position, string $collectionName, string $searchValue, string $queryBy, ?string $fielToFilter, ?string $filterValue): string
    {
        $url = $_ENV['TYPESENSE_URL'] . 'collections/' . $collectionName . '/documents/search';
        $url .= '?q=' . $searchValue;
        if ($queryBy != '') {
            $url .= '&query_by=' . $queryBy;
        }
        if ($filterValue != null || $fielToFilter != null) {
            $url .= '&filter_by=' . $fielToFilter . ':(' . $filterValue . ',' . self::DISTANCE . 'km)';
        }
        if (count($position) == 2 && $fielToFilter) {
            $url .= '&sort_by=' . $fielToFilter . '(' . $position[0] . ',' . $position[1] . '):asc';
        }
        $perPage = 200;
        $url .= '&page=1&per_page=' . $perPage;
        return $url;
    }

    /**
     * @param array $data
     * @return array<Station>
     */
    private function serializeStation(array $data, ?string $index = ''): array
    {
        $collectionDoc = new ArrayCollection($data);
        $collectionStation =  $collectionDoc->map(function ($station) use ($index) {
            $stationDenormalize = $this->serializer->serializer()->denormalize($index != '' ?  $station['document'] : $station, Station::class);
            return $stationDenormalize;
        });
        return $collectionStation->toArray();
    }
}
