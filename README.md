# EVE ESI Bundle
![](https://github.com/f1monkey/eve-esi-bundle/workflows/Tests/badge.svg) ![](https://img.shields.io/github/v/tag/f1monkey/eve-esi-bundle)

### Installation

@todo
```bash
$ composer require f1monkey/eve-esi-bundle
```
Add to `config/bundles.php`:
```php
<?php
return [
    // ...
    F1Monkey\EveEsiBundle\F1MonkeyEveEsiBundle::class => ['all' => true],
];
```
Create config file (i.e. `config/packages/request_handle.yaml`)

### Configuration

```yaml
request_handle:
    value_resolver:
        # controller arguments implementing this interface will be deserialized using RequestDeserializationValueResolver
        request_class: App\Model\RequestInterface
    request_validator:
        # controller arguments implementing this interface will be validated using RequestValidationListener
        request_class: App\Model\RequestInterface
    exception_log:
        # logger service id for exception logging (default value = @logger)
        logger: 'logger'
```

### ExceptionListener

#### Custom error response

If you need to customize error response, you should override exception response factory in your application's `services.yaml`
```yaml
services:
    F1Monkey\EveEsiBundle\Factory\ErrorResponseFactoryInterface:
        class: App\Factory\ErrorResponseFactory
```
#### Custom exception message

By default, error messages are overridden by default HTTP messages according to HTTP response code.
To set a custom error message, you should implement [UserFriendlyExceptionInterface](src/Exception/UserFriendlyExceptionInterface.php) in your Exception class.

#### X-Debug header

Because all exceptions are transformed to a "user-friendly" responses, debugging becomes harder: symfony error page will not appear at all.
To show the error page, two conditions must be met:
* `kernel.debug` parameter set to `true` (it is default setting for `dev` environment)
* `X-Debug` header is present in the request

### ExceptionLogListener

#### Customize logging

To customize logging you should override logger context provider service:
```yaml
services:
    F1Monkey\EveEsiBundle\Service\LogContextProviderInterface:
        class: App\Service\LogContextProvider
```
