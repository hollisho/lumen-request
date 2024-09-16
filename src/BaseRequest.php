<?php

namespace hollisho\lumen\request;

use hollisho\lumen\request\FormModel;
use Illuminate\Http\Request;
use ReflectionException;

class BaseRequest extends FormModel
{
    private $request;

    /**
     * 自动加载数据
     * @var bool
     */
    protected $autoLoad = true;

    /**
     * 自动验证数据
     * @var bool
     */
    protected $autoValidate = true;

    /**
     * 验证不通过抛异常
     * @var bool
     */
    protected $throwable = true;

    /**
     * BaseRequestBo constructor.
     * @param Request $request
     * @throws ReflectionException
     */
    public function __construct(Request $request)
    {
        if ($this->autoLoad) {
            if ($request->isJson()) {
                $data = $request->json()->all();
            } else if ($request->isMethod('GET')) {
                $data = $request->query();
            } else {
                $data = $request->input();
            }

            $this->load($data);
            $this->autoValidate && $this->validate($this->throwable);
            $this->request = $request;
        }
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}