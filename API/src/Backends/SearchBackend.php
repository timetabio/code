<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Backends
{
    use Timetabio\Framework\Backends\ElasticBackend;
    use Timetabio\Library\SearchTypes\SearchType;

    class SearchBackend
    {
        /**
         * @var ElasticBackend
         */
        private $elasticBackend;

        public function __construct(ElasticBackend $elasticBackend)
        {
            $this->elasticBackend = $elasticBackend;
        }

        public function search(string $query, SearchType $type, string $userId, int $limit, int $page): array
        {
            return $this->elasticBackend->search($type->getElasticType(), $limit * ($page - 1), $limit, [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'analyzer' => 'ttio_text',
                                    'type' => 'most_fields',
                                    'boost' => 2,
                                    'fields' => ['title', 'title.ngram', 'description', 'description.ngram']
                                ]
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'boost' => 4,
                                    'type' => 'most_fields',
                                    'analyzer' => 'ttio_text',
                                    'fields' => ['name', 'name.ngram']
                                ]
                            ],
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'type' => 'most_fields',
                                    'analyzer' => 'ttio_text',
                                    'fields' => ['body', 'body.ngram']
                                ],
                            ],
                        ],
                        'minimum_should_match' => 1,
                        'filter' => [
                            'terms' => [
                                '_feed_id' => [
                                    'index' => 'ttio',
                                    'type' => 'user',
                                    'id' => $userId,
                                    'path' => 'feeds'
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }

        public function getFeedPosts(string $feedId, int $limit, int $page): array
        {
            return $this->elasticBackend->search('post', $limit * ($page - 1), $limit, [
                'sort' => [
                    'created' => 'desc'
                ],
                'query' => [
                    'constant_score' => [
                        'filter' => [
                            'bool' => [
                                'must' => [
                                    [
                                        'term' => [
                                            '_feed_id' => $feedId
                                        ]
                                    ]
                                ],
                                'must_not' => [
                                    [
                                        'exists' => [
                                            'field' => 'archived'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }

        public function getUserFeeds(string $userId, int $limit, int $page): array
        {
            return $this->elasticBackend->search('feed', $limit * ($page - 1), $limit, [
                'sort' => [
                    'created' => 'desc'
                ],
                'query' => [
                    'terms' => [
                        '_feed_id' => [
                            'index' => 'ttio',
                            'type' => 'user',
                            'id' => $userId,
                            'path' => 'feeds'
                        ]
                    ]
                ]
            ]);
        }

        public function getUserFeed(string $userId, int $limit, int $page): array
        {
            return $this->elasticBackend->search('post', $limit * ($page - 1), $limit, [
                'sort' => [
                    'created' => 'desc'
                ],
                'query' => [
                    'constant_score' => [
                        'filter' => [
                            'bool' => [
                                'must' => [
                                    [
                                        'terms' => [
                                            '_feed_id' => [
                                                'index' => 'ttio',
                                                'type' => 'user',
                                                'id' => $userId,
                                                'path' => 'feeds'
                                            ]
                                        ]
                                    ]
                                ],
                                'must_not' => [
                                    [
                                        'exists' => [
                                            'field' => 'archived'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }
}
