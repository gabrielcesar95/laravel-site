<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

trait Authorizable
{
    private $abilities = [
        'index' => 'index',
        'activities' => 'activities',
        'access' => 'access',
        'edit' => 'edit',
        'show' => 'show',
        'filter' => 'index',
        'update' => 'edit',
        'create' => 'create',
        'store' => 'create',
        'delete' => 'delete',
        'destroy' => 'delete'
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {

        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $route = explode('.', Request::route()->getName());

        if (in_array('admin', Request::route()->gatherMiddleware())) {
            Arr::forget($route, 0);
        }

        $action = Arr::get($this->getAbilities(), $method);

        if (count($route) > 2) {
            return $action ? implode('_', $route) . '@' . $action : null;
        }
        return $action ? $route[1] . '@' . $action : null;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
