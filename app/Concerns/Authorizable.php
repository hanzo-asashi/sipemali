<?php

namespace App\Concerns;

use Arr;
use Request;

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
        'bulkActions' => 'bulk-actions',
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters): mixed
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility(
        $method
    ): ?string {
        $routeName = explode('.', Request::route()->getName());
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
