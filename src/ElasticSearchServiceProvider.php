<?php

declare(strict_types=1);

namespace Matchish\ScoutElasticSearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

final class ElasticSearchServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()->setHosts([config('elasticsearch.host')])->build();
        });

        $this->publishes([
            __DIR__.'/../config/elasticsearch.php' => config_path('elasticsearch.php'),
        ], 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function provides(): array
    {
        return [Client::class];
    }
}
