Я решил выполнить задание 2-мя методами:
1) Этот репозиторий
2) *github.com/vbudai/inline-test*

База данных MySQL добавлена в репозиторий и называется **"inline-test.sql"**

Загрузкой постов и комментариев занимается контроллер **LoadController**
Поиском и выводом данных - **SearchController**

Подключение к БД выполняется в **core/database/**
С таблицей постов работает модель **PostModel**
С таблицей комментариев работает **CommentsModel**

Данные выводятся в формате json. Также, учитывая, что у одной записи может быть несколько комментариев с искомой строкой, а также то, что таких записей может быть несколько, выводимые данные сгруппированы по постам, где к каждому посту прикреплены все его комментарии с искомой подстрокой.