<?php

namespace MichielKempen\LumenHttpHelpers\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request as BaseRequest;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

abstract class Request extends BaseRequest implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * The container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * Set the container implementation.
     *
     * @param  Container  $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get the validator instance for the request.
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $factory = $this->container->make(ValidationFactory::class);

        $validator = $factory->make(
            $this->all(), $this->rules(), $this->messages()
        );

        return $validator;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $data = [
            'message' => 'Wrong data.',
            'errors' => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($data, 422));
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() : array
    {
        return [];
    }
}
