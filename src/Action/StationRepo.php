<?php

namespace App\Action;

use App\Entity\Station;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\Common\Collections\ArrayCollection;

class StationRepo
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

    public function __construct(HttpClientInterface $client,SerializerInterface $serializer )
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
    public function getStationsAction(array $position, string $collectionName, string $searchValue, string $queryBy, ?string $fielToFilter, ?string $filterValue): array
    {
        $stations = $this->getStationFiltered($position, $collectionName, $searchValue, $queryBy, $fielToFilter, $filterValue);
        return $stations;
    }

    private function getStationFiltered(array $position, string $collectionName, string $searchValue, string $queryBy, ?string $fielToFilter, ?string $filterValue): array
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
            throw new HttpException(401, 'error serializeData: key hits not exists');
        }
        $result = $this->serializeData($dataArray['hits']);
        return $result;
    }
    private function createURL(array $position, string $collectionName, string $searchValue, string $queryBy, ?string $fielToFilter, ?string $filterValue): string
    {
        $url = $_ENV['TYPESENSE_URL'] . 'collections/' . $collectionName . '/documents/search';
        $url .= '?q=' . $searchValue;
        if ($queryBy != '') {
            $url .= '&query_by=' . $queryBy;
        }
        if ($filterValue != null || $fielToFilter != null) {
            $url .= '&filter_by=' . $fielToFilter . ':(' . $filterValue.','.self::DISTANCE.'km)';
        }
        if (count($position) == 2 && $fielToFilter) {
            $url .= '&sort_by='.$fielToFilter.'('.$position[0].','.$position[1].'):asc';
        }
        $perPage = 200;
        $url .= '&page=1&per_page=' . $perPage;
        return $url;
    }   

    /**
     * @param array $data
     * @return array<Station>
     */
    private function serializeData(array $data): array
    {
        $collectionDoc = new ArrayCollection($data);
        $collectionStation =  $collectionDoc->map(function ($station) {
            $st = $this->serializer->serializer()->denormalize($station['document'], Station::class);
            return $st;
        });
        return $collectionStation->toArray();
    }
}
