<?php

namespace MichielKempen\LumenHttpHelpers;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request as BaseRequest;
use Illuminate\Support\ServiceProvider;
use MichielKempen\LumenHttpHelpers\Requests\Request;

class LumenHttpHelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(Request::class, function (Request $request, Container $app) {
            $this->initializeRequest($request, $app['request']);
            $request->setContainer($app);
        });

        $this->app->afterResolving(ValidatesWhenResolved::class, function (ValidatesWhenResolved $resolved) {
            $resolved->validateResolved();
        });
    }

    /**
     * Initialize the form request with data from the given request.
     *
     * @param  Request $form
     * @param  BaseRequest  $current
     * @return void
     */
    protected function initializeRequest(Request $form, BaseRequest $current)
    {
        $files = $current->files->all();
        $files = is_array($files) ? array_filter($files) : $files;

        $form->initialize(
            $current->query->all(), $current->request->all(), $current->attributes->all(),
            $current->cookies->all(), $files, $current->server->all(), $current->getContent()
        );

        $form->setJson($current->json());

        $form->setUserResolver($current->getUserResolver());
        $form->setRouteResolver($current->getRouteResolver());
    }
}
