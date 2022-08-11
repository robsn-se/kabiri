-- SELECT - извлечение данных из базы данных
-- UPDATE - обновление данных в базе данных
-- DELETE - удаляет данные из базы данных
-- INSERT INTO - вставка новых данных в базу данных
-- CREATE DATABASE - создает новую базу данных
-- ALTER DATABASE - изменяет базу данных
-- CREATE TABLE - создает новую таблицу
-- ALTER TABLE - изменения в таблице
-- DROP TABLE - удаляет таблицу
-- CREATE INDEX - создает индекс (ключ поиска)
-- DROP INDEX - удаляет индекс

  
  
  
  SELECT * FROM `actions`;  
-- Выборка всех полей из таблиц


SELECT `title`, `discription`, `location` AS 'place' FROM `actions`;
-- Запрос из нескольких полей и переименование поля 'AS'


SELECT `id`, `title`, `discription`, `location` AS 'place' FROM `actions` WHERE `id` = 1 OR `title` = 'авария';
-- Выбор данных по условию WHERE, выбор с или-OR


SELECT `id`, `title`, `discription`, `location` AS 'place' FROM `actions` WHERE `id` = 1 AND `title` = 'авария';
-- Выбор данных по условию WHERE, выбор с и-AND


SELECT * FROM `comments` WHERE `action` = 1 ORDER BY `id` DESC;
-- ASC прямой порядок (по умолчанию) DESC обратный порядок, выдачи


SELECT * FROM `comments` WHERE `action` = 1 ORDER BY `id` DESC LIMIT 5;
-- LIMIT ограничение, (последние 5 комментариев);


INSERT INTO `users` (`login`, `name`, `birthday`, `password`) VALUES('ssnkd', 'дима', '2003-09-05', 'jhjvjb');
-- Вставить в "INSERT INTO"  значения "VALUES"


INSERT INTO `users` SET `login` = 'trewq', `name` = 'рома', `password` = 'asdfg', `birthday` = '2000-11-15';
-- Вставка с использованием SET


UPDATE `users` SET `name` = 'петя', `password` = 'asdfg' WHERE `name` = '';
-- Обновление данных в строках


DELETE  FROM `users` WHERE `id` = 5;



SELECT * FROM `users` WHERE `id` = (SELECT `user` FROM `actions` WHERE `title` = 'авария');
-- подзапрос (SELECT `user` FROM `actions` WHERE `title` = 'авария') - помогает получить данные для основного запроса



SELECT a.`title` AS 'action', u.`name` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image' FROM `actions` a
INNER JOIN `users` u ON u.`id` = a.`user`
INNER JOIN `actions_images` ai ON a.`id` = ai.`action`
WHERE a.`title` = 'авария';
-- джоины - присоединение других таблиц по условию, алиасы (a.`title`)- это сокращение



SELECT a.`title` AS 'action', u.`name` AS 'user', a.`likes` AS 'rating', ai.`url` AS 'image' FROM `actions` a
LEFT JOIN `users` u ON u.`id` = a.`user`
LEFT JOIN `actions_images` ai ON a.`id` = ai.`action`
WHERE a.`likes` = 1 OR u.`login` = 'ruben-se'
HAVING `image` IS NULL
ORDER BY a.`likes` DESC 
LIMIT 3;
-- СЛОЖНЫЙ SQL Запрос
-- IS NULL - найти то значение, которое пустое
-- IS NOT NULL- найти значение которое не пустое
-- LIMIT 2, 3 ;- выбрать 3 значения, минуя первые 2  (пример с рейтингом)