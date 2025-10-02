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