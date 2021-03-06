# EVE ESI Bundle
![](https://github.com/f1monkey/eve-esi-bundle/workflows/Tests/badge.svg) ![](https://img.shields.io/github/v/tag/f1monkey/eve-esi-bundle)

Symfony4/Symfony5 bundle for [EVE Swagger Interface](https://esi.evetech.net)

### Installation

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
    user_agent: 'Test/1.0' # example User-Agent header for SSO/ESI requests, default is null, optional parameter
    oauth: # required if you want to use EVE SSO, otherwise can be skipped
        callback_url: '%env(EVE_ESI_CALLBACK_URL)%' # your app's callback url (same as in your application settings)
        client_id: '%env(EVE_ESI_CLIENT_ID)%' # your app's client id
        client_secret: '%env(EVE_ESI_CLIENT_SECRET)%' # your app's client secret
```

### Usage

#### SSO (obtain access tokens)

##### Generate redirect URL

First of all, you need to redirect the user to the authentication URL.
Use [OAuthServiceInterface::createRedirectUrl](./src/Service/OAuth/OAuthServiceInterface.php) to generate this URL.

```php
<?php

use Doctrine\Common\Collections\ArrayCollection;
use F1monkey\EveEsiBundle\Dto\Scope;
use F1monkey\EveEsiBundle\Service\OAuth\OAuthServiceInterface;

class MyService {
    public function __construct(OAuthServiceInterface $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * Generate url to redirect user for authentication
     */
    public function getRedirectUrl()
    {
        // Tokens will be generated with he scopes you set here
        $scopes = new ArrayCollection(
            [
                new Scope('publicData'),
                new Scope('esi-calendar.respond_calendar_events.v1'),
            ]
        );

        return $this->oauthService->createRedirectUrl($scopes);
    }
}
```

##### Handle authorization callback

After user authentication, he will be redirected back to the callback_url specified in the configuration.
The request will contain an authorization code (i.e https://localhost/callback?code=qwerty).
You should use this code to obtain access and refresh tokens:

```php
<?php
use F1monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;

// ...

    public function verifyAuthCode(string $authCode)
    {
        try {
            $tokens = $this->oauthService->verifyCode($authCode);
        } catch (OAuthRequestException $e) {
            // handle request exceptions (4xx and 5xx errors)
            $errorResponse = $e->getErrorResponse();
            $httpCode = $e->getStatusCode();
        }
        $accessToken = $tokens->getAccessToken(); // this token will be used in ESI methods (https://esi.evetech.net)
        $refreshToken = $tokens->getRefreshToken(); // this token is to get a new accessToken when it is expired (@see next method)

        // save access and refresh tokens to database
    }
```
##### Refresh access token
The access token token is valid for 15 minutes.
After that, you should use the refresh token to get a new one:
```php
try {
    $tokens = $this->oauthService->refreshToken($refreshToken);
} catch (OAuthRequestException $e) {
    // handle request exceptions (4xx and 5xx errors)
}
// save refresh and access tokens to database
```

#### ESI

##### Get character info by access token
```php
<?php

use F1monkey\EveEsiBundle\Exception\Esi\EsiRequestException;
use F1monkey\EveEsiBundle\Service\Esi\VerifyTokenServiceInterface;

class MyService
{
    // ...
    public function __construct(VerifyTokenServiceInterface $verifyTokenService)
    {
        $this->verifyTokenService = $verifyTokenService;
    }

    public function getCharacterInfo(string $accessToken)
    {
        try {
            $response = $this->verifyTokenService->verifyAccessToken($accessToken);
        } catch (EsiRequestException $e) {
            // handle request exception
        }
        $characterId   = $response->getCharacterId();
        $characterName = $response->getCharacterName();
        $scopes        = $response->getScopes();
    }
}
```

### Using ETag

Request methods having `$eTag` argument should be cacheable ([docs](https://developers.eveonline.com/blog/article/esi-etag-best-practices)).

Response will contain a cache tag (see [HasETagInterface](./src/Dto/Esi/Response/HasETagInterface.php)).
If you pass this value in the next call and value is not changed, you will get NotModifiedException. It means you should use cached response data.
Example:
```php
<?php

/** @var \F1monkey\EveEsiBundle\Service\Esi\MarketServiceInterface $service */
$response = $service->getV2CharactersOrders('token', 123456);

$eTag = $response->getEtag();
try {
    $response = $service->getV2CharactersOrders('token', 123456, $eTag);
} catch (\F1monkey\EveEsiBundle\Exception\Esi\NotModifiedException $e) {
    // use previous response
}
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
