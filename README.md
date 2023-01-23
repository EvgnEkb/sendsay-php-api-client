# sendsay-php-api-client
Php пакет для добавления подписчика в сервис SendSay по api

```
composer require evgeny/sendsay-php-api-client:dev-main
```

```php

$sendSay = new SendSayApiClient('URL', 'LOGIN', 'PASSWORD', 'GROUP_ID');

$sendSay->addSubscriber('test@test.ru');

```
