## basic use
```php

//定义Request对象
class RequestBo extend BaseRequest
{
    public $html_content;

    public $language_edit = 0;

    public function rules()
    {
        return [
            'html_content' => ['required'],
        ];
    }

    protected function messages()
    {
        return [
            'html_content.required' => 'html_content is required',
        ];
    }
}


/**
   * @param RequestBo $requestBo
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws \App\Exceptions\BusinessException
   */
  public function create(RequestBo $requestBo, Request $request)
  {
      return new SuccessResponseVo($requestBo->toArray());
  }

```
