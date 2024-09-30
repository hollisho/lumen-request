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

//在控制器中注入Reqeust
class IndexController extends Controller
{

    /**
     * @param FetchHtmlRequest $request
     * @param DomRenderService $renderService
     * @return \Illuminate\Http\JsonResponse
     */
    public function parserHtml(RequestBo $request)
    {
        ......
    }
}

```
