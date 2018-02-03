<?php

namespace MichielKempen\LumenHttpHelpers\Transformers;

abstract class Transformer
{
	/**
	 * @param $model
	 * @return array
	 */
	public abstract function transform($model) : array;
}