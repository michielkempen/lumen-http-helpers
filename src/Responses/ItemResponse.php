<?php

namespace MichielKempen\LumenHttpHelpers\Responses;

use MichielKempen\LumenHttpHelpers\Transformer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemResponse implements Responsable
{
	/**
	 * @var Model
	 */
	private $model;

	/**
	 * @var Transformer
	 */
	private $transformer;

	/**
	 * PaginatedResponse constructor.
	 *
	 * @param Model $model
	 * @param string $transformerClass
	 */
	public function __construct(Model $model, string $transformerClass)
	{
		$this->model = $model;
		$this->transformer = app($transformerClass);
	}

	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function toResponse($request)
	{
		return response()->json([
			'data' => $this->transformer->transform($this->model)
		]);
	}
}