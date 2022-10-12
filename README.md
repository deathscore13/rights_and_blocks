# Rights & Blocks
### Добавляет систему прав и блокировок в BotEngineVK<br><br>

Описания настроек находятся в файле настроек.

<br><br>
## Команды
1. **rights** <подкоманда> - Управление правами
* **set** <права> <0/1> <цель> [peer_id/chats/pm/every или текущий чат по умолчанию] - Установка значения прав для пользователя
* **info** <цель> - Узнать права пользователя
* **list** - Список с именами и описаниями доступных прав
2. **blocks** <подкоманда> - Управление блокировками
* **set** <блок> <0/1> <цель> [peer_id/chats/pm/every или текущий чат по умолчанию] - Установка значения блокировки для пользователя
* **info** <цель> - Узнать блокировки пользователя
* **list** - Список с именами и описаниями доступных блоков

<br><br>
## Права
1. **root** - Все права (может быть выдано только администратором чата);
2. **blocks** - Выдача блокировок.

<br><br>
## Логика установки и проверки прав/блокировок
**chats** - все чаты;<br>
**pm** - ЛС;<br>
**every** - везде.<br>

Права/блокировки будут действовать именно для тех чатов, где было указано при выдаче. Например, чтобы пользователь мог выдавать блокировки для ЛС, ему потребуется права **blocks** для **pm** или **every**.

<br><br>
## Требования
1. BotEngineVK.

<br><br>
## Установка
1. Распределить файлы для по директории **BotEngineVK**.
