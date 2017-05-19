Описание
------------
Задание реализовано в виде  модуля для Yii 2.*(advanced template)

Зависимости
-----------
- kartik-v/yii2-widget-fileinput
```
$ php composer.phar require kartik-v/yii2-widget-fileinput "@dev"
```
Установка
-----------
- Клонируйте репозиторий
- Скопируйте папку alcora в папку frontend/modules
- Примените миграцию:
```
php yii migrate/up --migrationPath=@frontend/modules/alcora/migrations
```
- Добавьте в frontend/config/main.php следующие настройки:
```
'modules' => [
...
  'alcora' => [
        'class' => 'frontend\modules\alcora\Alcora',
        'defaultRoute' => 'main/index'
  ],
...
]
```
- Для отправки писем пропишите Ваши настройки для компонента mailer в файле frontend/config/main.php:
```
'components' => [
...
  'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
          'messageConfig' => [
            'charset' => 'UTF-8',
          ],
          'useFileTransport' => false,
  ],
...
]
```
