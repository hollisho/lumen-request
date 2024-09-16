<?php

namespace hollisho\lumen\requeset;


use hollisho\lumen\request\InvalidParameterException;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use hollisho\objectbuilder\HObject;

class FormModel extends HObject
{

    /**
     * @var array
     */
    private $errors;


    protected function rules() {
        return [];
    }

    protected function messages() {
        return [];
    }

    /**
     * @param $data
     * @return bool
     * @throws \ReflectionException
     */
    public function load($data) {
        if (!empty($data) && is_array($data)) {
            $this->setAttributes($data);

            return true;
        }

        return false;
    }


    /**
     * @param bool $throwable
     * @return bool
     * @throws \ReflectionException
     */
    public function validate($throwable = false) {
        /* @var $validatorFactory Factory */
        $validatorFactory = app('validator');
        /* @var $validator Validator */
        $validator = $validatorFactory->make($this->getAttributes(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            if ($throwable) {
                throw new InvalidParameterException($validator->errors()->first());
            }
            $this->setErrors($validator->errors()->getMessages());
        }

        return !$this->hasError();
    }


    /**
     * @param null|string $attribute
     * @return bool
     */
    public function hasError($attribute = null) {
        return $attribute === null ? !empty($this->getErrors()) : isset($this->errors[$attribute]);
    }

    /**
     * @return mixed
     */
    public function getErrors() {
        return $this->errors === null ? [] : $this->errors;
    }

    /**
     * @param array $errors
     */
    protected function setErrors(array $errors) {
        $this->errors = $errors;
    }

}