DROP DATABASE IF EXISTS take_eir;
CREATE DATABASE take_eir;
use take_eir;

CREATE TABLE `devices` (
  `id_device` varchar(255) PRIMARY KEY
);

CREATE TABLE `patients` (
  `id_patient` varchar(255) PRIMARY KEY,
  `name` varchar(255),
  `surname` varchar(255),
  `doctor_email` varchar(255),
  `id_device` varchar(255)
);

CREATE TABLE `devices_users` (
  `id_user_device` varchar(255) PRIMARY KEY,
  `id_user` varchar(255),
  `id_device` varchar(255)
);

CREATE TABLE `users` (
  `id_user` varchar(255) PRIMARY KEY,
  `name` varchar(255),
  `surname` varchar(255),
  `email` varchar(255),
  `password` text,
  `id_role` integer,
  `created_at` timestamp,
  `gender` char,
  `notification` char
);

CREATE TABLE `roles` (
  `id_role` integer PRIMARY KEY AUTO_INCREMENT,
  `role_name` varchar(255),
  `role_permission` integer
);

CREATE TABLE `metrics` (
  `id_device` varchar(255),
  `metric_type` integer,
  `entry_time` timestamp,
  `value` integer
);

CREATE TABLE `metrics_type` (
  `metric_type` integer PRIMARY KEY AUTO_INCREMENT,
  `metric_name` varchar(255)
);

CREATE TABLE `faq` (
  `id_post` integer PRIMARY KEY AUTO_INCREMENT,
  `subject` TEXT,
  `body` TEXT
);

CREATE TABLE `tickets` (
  `tickets_id` integer PRIMARY KEY AUTO_INCREMENT,
  `id_user` varchar(255),
  `created_at` timestamp,
  `state` varchar(255),
  `id_tag` integer,
  `subject` TEXT,
  `body` TEXT
);

CREATE TABLE `tags` (
  `id_tag` integer PRIMARY KEY AUTO_INCREMENT,
  `tag_name` varchar(255)
);

CREATE TABLE `reset_passwd` (
  `email` varchar(255),
  `token` varchar(255)
);

CREATE TABLE `deleted_users` (
  `reason` TEXT
);

CREATE TABLE `alert_threshold` (
  `id_device` varchar(255),
  `metric_type` integer,
  `value` varchar(255)
);

ALTER TABLE `tickets` ADD FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`);

ALTER TABLE `tickets` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `users` ADD FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

ALTER TABLE `patients` ADD FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`);

ALTER TABLE `devices_users` ADD FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`);

ALTER TABLE `devices_users` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `metrics` ADD FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`);

ALTER TABLE `metrics` ADD FOREIGN KEY (`metric_type`) REFERENCES `metrics_type` (`metric_type`);

ALTER TABLE `alert_threshold` ADD FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`);

ALTER TABLE `alert_threshold` ADD FOREIGN KEY (`metric_type`) REFERENCES `metrics_type` (`metric_type`);
