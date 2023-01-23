# sendsay-php-api-client
Php пакет для раоты с api сервиса Send Say.

```
composer require evgeny/sendsay-php-api-client
```

Возможности:

- Заполнить кастомное поле подписчика
- Добавить подписчика

```php

$sendSay = new SendSayApiClient('URL', 'LOGIN', 'PASSWORD', 'GROUP_ID');

$sendSay->addCustomField('tip_podpischika', 'Блог');

$sendSay->addSubscriber('test@test.ru');

```
