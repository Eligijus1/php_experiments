<?php

namespace Elasticsearch;

use Throwable;

class ElasticsearchClient
{
    private $elasticClient;

    public function __construct(string $elasticCloudWebUiCloudId, string $elasticCloudWebUiApiId, string $elasticCloudWebUiApiKey)
    {
        $this->elasticClient = ClientBuilder::create()
            ->setElasticCloudId($elasticCloudWebUiCloudId)
            ->setApiKey($elasticCloudWebUiApiId, $elasticCloudWebUiApiKey)
            ->build();
    }
	
    public function getIndexDocumentsCount(string $index, int $precisionThreshold = 1000000): int
    {
        $params = [
            'index' => $index,
            'body' => [
                "size" => 0,
                "_source" => false,
                "track_total_hits" => true,
                //'query' => $query,
                'aggs' => [
                    "type_count" => [
                        "cardinality" => [
                            "field" => "id",
                            "precision_threshold" => $precisionThreshold
                        ]
                    ]
                ]
            ]
        ];

        return (int)$this->searchDocumentsInIndex($params)['hits']['total']['value'];
    }

    public function searchDocumentsInIndexWithSql(string $sql): array
    {
        $params = [
            'body' => [
                'query' => $sql
            ]
        ];

        try {
            $response = $this->elasticClient->sql()->query($params);
        } catch (Throwable $e) {
            $this->logException($e);
            echo("Failed SQL: $sql");
            return [];
        }

        return $response;
    }
	
    public function createOrUpdateDocumentInIndex(string $index, string $id, array $body): bool
    {
        $params = [
            'index' => $index,
            'id' => $id,
            'body' => $body
        ];

        try {
            //$response = $this->elasticClient->index($params);
            $this->elasticClient->index($params);
        } catch (Throwable $e) {
            $this->logException($e);
            return false;
        }

        return true;
    }
	
    public function searchDocumentsInIndex(array $params): array
    {
        try {
            $response = $this->elasticClient->search($params);
        } catch (Throwable $e) {
            $this->logException($e);
            return [];
        }

        return $response;
    }
}