<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Client;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ClientsQuery extends Query
{
    protected $attributes = [
        'name' => 'clients',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Client');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'page' => [
                'type' => Type::int(),
            ],
            'limit' => [
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        
        $clients = Client::filter($args)
            ->select($select);

        return $clients->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
