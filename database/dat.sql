--
-- Vytvorenie tabuliek
--

CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(10) unsigned NOT NULL,
	`name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `moderators` (
	`user_id` int(10) unsigned DEFAULT NULL,
	`mail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
	`password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
	`property1` text COLLATE utf8_unicode_ci,
	`property2` text COLLATE utf8_unicode_ci,
	`property3` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `forums` (
	`forum_id` int(10) unsigned NOT NULL,
	`name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	`access` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `topics` (
	`topic_id` int(10) unsigned NOT NULL,
	`forum_id` int(10) unsigned DEFAULT NULL,
	`user_id` int(10) unsigned DEFAULT NULL,
	`name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
	`lock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `comments` (
	`comment_id` int(10) unsigned NOT NULL,
	`topic_id` int(10) unsigned DEFAULT NULL,
	`user_id` int(10) unsigned DEFAULT NULL,
	`text` text COLLATE utf8_unicode_ci,
	`timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vloženie testovacích dát
--

INSERT INTO `moderators` (`user_id`, `mail`, `password`, `property1`, `property2`, `property3`) VALUES
(1, 'a@a.a', 'abc', NULL, NULL, NULL),
(2, 'b@b.b', 'abc', NULL, NULL, NULL),
(3, 'c@c.c', 'abc', NULL, NULL, NULL);

INSERT INTO `users` (`user_id`, `name`) VALUES
(1, 'Tester 1'),
(2, 'Tester 2'),
(3, 'Tester 3');

INSERT INTO `forums` (`forum_id`, `name`, `access`) VALUES
(1, 'News', 1),
(2, 'Questions', 0);

--
-- Indexy pre tabuľky
--

ALTER TABLE `users`
	ADD PRIMARY KEY (`user_id`);
  
ALTER TABLE `moderators`
	ADD KEY `user_id` (`user_id`);
  
ALTER TABLE `forums`
	ADD PRIMARY KEY (`forum_id`);
  
ALTER TABLE `topics`
	ADD PRIMARY KEY (`topic_id`),
	ADD KEY `forum_id` (`forum_id`),
	ADD KEY `user_id` (`user_id`);
  
ALTER TABLE `comments`
	ADD PRIMARY KEY (`comment_id`),
	ADD KEY `topic_id` (`topic_id`),
	ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pre tabulky
--

ALTER TABLE `users`
	MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
	
ALTER TABLE `forums`
	MODIFY `forum_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
	
ALTER TABLE `topics`
	MODIFY `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
  
ALTER TABLE `comments`
	MODIFY `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

--
-- Obmedzenia pre tabuľky
--

ALTER TABLE `moderators`
	ADD CONSTRAINT `moderators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `topics`
	ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`) ON DELETE CASCADE,
	ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

ALTER TABLE `comments`
	ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE,
	ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;
  
 
