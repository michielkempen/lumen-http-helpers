<?php

namespace MichielKempen\LumenHttpHelpers\Tests;

use Laravel\Lumen\Application;
use Illuminate\Http\Request;

trait SetRequestForConsole
{
    /**
     * @param Application $app
     */
    public function setRequestForConsole(Application $app)
    {
        $uri = $app->make('config')->get('app.url');

        $components = parse_url($uri);

        $server = $_SERVER;

        if (isset($components['path'])) {
            $server = array_merge($server, [
                'SCRIPT_FILENAME' => $components['path'],
                'SCRIPT_NAME' => $components['path'],
            ]);
        }

        $app->instance('request', Request::create(
            $uri, 'GET', [], [], [], $server
        ));
    }
}