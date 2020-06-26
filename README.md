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
    F1monkey\EveEsiBundle\F1monkeyEveEsiBundle::class => ['all' => true],
];
```
Create config file (i.e. `config/packages/f1monkey_eve_esi.yaml`)

### Configuration

```yaml
f1monkey_eve_esi:
    oauth: # optional, if you want to use EVE SSO
        callback_url: '%env(EVE_ESI_CALLBACK_URL)%' # optional, if you need to use EVE SSO
        client_id: '%env(EVE_ESI_CLIENT_ID)%' # your app's callback url
        client_secret: '%env(EVE_ESI_CLIENT_SECRET)%' # your app's client secret
```

### Testing

Run Codeception tests:
```
$ composer test
```
Run the static analyzer:
```
$ composer phpstan
```