# Laravel Advcash package
You can install it by running below command in the root folder of Laravel:
```$xslt
composer require codemenco/advcash
```
### Settings
By default, receive routes are disabled. You can turn it on through ADVCASH_DEF=true

To put your routes, such methods are available at the facade.

$route_url - A clean link to the page(It is relate to SCI not API).
```php
static setSuccessRoute(string $route_url): void
static setStatusRoute(string $route_url): void
static setFailRoute(string $route_url): void
```

### Add to .env
```text
#SCI
ADVCASH_NAME=
ADVCASH_EMAIL=
ADVCASH_PASS=

#API
ADVCASH_API_NAME=
ADVCASH_API_EMAIL=
ADVCASH_API_PASS=
```

### If you need access to the view, run the command

```$xslt
php artisan vendor:publish --provider="Codemenco\Advcash\AdvcashServiceProvider"
```

### Events
```text
Codemenco\Advcash\Events\AdvcashPaymentIncome (AdvcashConfirmResponse $payment)
Codemenco\Advcash\Events\AdvcashPaymentCancel (array $payment)
Codemenco\Advcash\Events\AdvcashPaymentStatus (AdvcashConfirmResponse $payment)
```

### Usage

```php
$formHtml = Advcash::createBitcoinRequest(float $amount, string $order_id): string
AdvcashApi::sendMoney(float $amount, 'EUR', string $email, string $note, false): string
```
