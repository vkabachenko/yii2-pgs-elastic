<?php


namespace app\models;


use yii\elasticsearch\ActiveRecord;

class CompanySearch extends ActiveRecord
{
    public static function index()
    {
        return 'company_search';
    }

    public function attributes()
    {
        return ['name', 'income', 'description'];
    }

    public static function mapping()
    {
        return [
            // Field types: https://www.elastic.co/guide/en/elasticsearch/reference/current/mapping.html#field-datatypes
            'company-search' => [
                'properties' => [
                    'name'     => ['type' => 'text'],
                    'income'      => ['type' => 'integer'],
                    'description'      => ['type' => 'text'],
                ]
            ]
        ];
    }

    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            //'aliases' => [ /* ... */ ],
            'mappings' => static::mapping(),
            'settings' => [
                'analysis' => [
                    'char_filter' => [
                        'replace' => [
                            'type' => 'mapping',
                            'mappings' => [
                                '&=> and '
                            ],
                        ],
                    ],
                    'filter' => [
                        'word_delimiter' => [
                            'type' => 'word_delimiter',
                            'split_on_numerics' => false,
                            'split_on_case_change' => true,
                            'generate_word_parts' => true,
                            'generate_number_parts' => true,
                            'catenate_all' => true,
                            'preserve_original' => true,
                            'catenate_numbers' => true,
                        ],
                        'trigrams' => [
                            'type' => 'ngram',
                            'min_gram' => 4,
                            'max_gram' => 6,
                        ],
                    ],
                    'analyzer' => [
                        'default' => [
                            'type' => 'custom',
                            'char_filter' => [
                                'html_strip',
                                'replace',
                            ],
                            'tokenizer' => 'whitespace',
                            'filter' => [
                                'lowercase',
                                'word_delimiter',
                                'trigrams',
                            ],
                        ],
                    ],
                ],
            ]
        ]);
    }


    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index());
    }

}