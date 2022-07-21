<?php

namespace App\Concerns;

use Arr;
use Illuminate\Auth\Access\AuthorizationException;
use Request;
use Symfony\Component\HttpFoundation\Response;

trait Authorizable
{
    private array $abilities = [
        'index' => 'show',
        'edit' => 'update',
        'show' => 'show',
        'update' => 'update',
        'create' => 'create',
        'store' => 'create',
        'destroy' => 'delete',
        'detail' => 'detail',
        'restore' => 'restore',
        'backup' => 'backup',
        'manage' => 'manage',
        'forceDelete' => 'force-delete',
        'bulkActions' => 'bulk-actions',
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return Response
     *
     * @throws AuthorizationException
     */
    public function callAction($method, $parameters): Response
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return $this->callAction($method, $parameters);
    }

    public function getAbility($method): ?string
    {
        $routeName = explode('.', Request::route()?->getName());
        $action = Arr::get($this->getAbilities(), $method);

        return $action ? $action.' '.$routeName[0] : null;
    }

    private function getAbilities(): array
    {
        return $this->abilities;
    }

    public function setAbilities($abilities): void
    {
        $this->abilities = $abilities;
    }
}
