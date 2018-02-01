<?php

namespace MichielKempen\LumenHttpHelpers\Transformers;

use Illuminate\Database\Eloquent\Model;

abstract class Transformer
{
	/**
	 * @param Model $model
	 * @return array
	 */
	public abstract function transform($model) : array;
}