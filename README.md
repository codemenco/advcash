# Laravel Advcash package

### Settings
By default, receive routes are disabled. You can turn it on through ADVCASH_DEF=true

To put your routes, such methods are available at the facade.

$route_url - A clean link to the page.
```php
static setSuccessRoute(string $route_url): void
static setStatusRoute(string $route_url): void
static setFailRoute(string $route_url): void
```

### Add to .env
```text
ADVCASH_NAME=
ADVCASH_EMAIL=
ADVCASH_PASS=
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
```
