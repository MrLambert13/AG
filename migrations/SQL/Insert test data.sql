INSERT INTO `currency` (`id`, `name`, `code`) VALUES
(1, 'dollar', 1),
(2, 'euro', 2),
(3, 'rub', 3);

INSERT INTO `countries` (`id`, `name`, `id_currency`) VALUES
(1, 'USA', 1),
(2, 'Austria', 2),
(3, 'Russia', 3),
(4, 'Germany', 2);

INSERT INTO `regions` (`id`, `name`, `description`, `id_country`) VALUES
(1, 'Москва', 'Москва и область', 3),
(2, 'Ивановская область', 'Ивановская область', 3),
(3, 'Белгородская область', 'Белгородская область', 3),
(4, 'Тульская область', 'Тульская область', 3),
(5, 'Владимирская область', 'Владимирская область', 3);

INSERT INTO `cities` (`id`, `name`, `timezone`, `id_region`) VALUES
(1, 'Москва', 4, 1),
(2, 'Белгород', 5, 3),
(3, 'Тула', 4, 4),
(4, 'Иваново', 4, 2),
(5, 'Красногорск', 4, 1),
(6, 'Химки', 4, 1);

INSERT INTO `request_statuses` (`id`, `name`) VALUES
(1, 'Создана'),
(2, 'В работе'),
(3, 'Приостановлена'),
(4, 'Выполнена');

INSERT INTO `motors` (`id`, `name`) VALUES
(1, 'бензин'),
(2, 'дизель'),
(3, 'электро'),
(4, 'гибрид-газ'),
(5, 'гибрид-электро');

INSERT INTO `car_equips` (`id`, `name`) VALUES
(1, 'Автосигнализация'),
(2, 'Противоугонные комплексы'),
(3, 'Блокираторы капота'),
(4, 'Видеорегистратор'),
(5, 'Комплексная система контроля «слепых» зон'),
(6, 'Дополнительные фары');

INSERT INTO `car_brands` (`id`, `name`) VALUES
(1, 'Ford'),
(2, 'BMW'),
(3, 'Mercedes-AMG'),
(4, 'Opel'),
(5, 'Porsche'),
(6, 'Volkswagen');

INSERT INTO `transmissions` (`id`, `name`) VALUES
(1, 'АКПП-гидро'),
(2, 'АКПП-робот'),
(3, 'АКПП-вариатор'),
(4, 'МКПП');

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'client'),
(2, 'sto'),
(3, 'guest'),
(4, 'admin');

INSERT INTO `car_gens` (`id`, `name`) VALUES
(1, 'gen 1 '),
(2, 'gen 2'),
(3, 'gen 3'),
(4, 'gen 4');

INSERT INTO `car_types` (`id`, `name`) VALUES
(1, 'Седан'),
(2, 'Универсал'),
(3, 'Хэтчбэк'),
(4, 'Купе');

INSERT INTO `car_models` (`id`, `name`, `id_car_brand`, `id_car_equip`, `year_from`, `year_to`, `id_car_gen`, `id_car_type`) VALUES
(1, '730i M Sport Pure', 2, 2, 2001, NULL, 3, 1),
(2, '750i xDrive', 2, 1, 2007, NULL, 4, 1),
(3, 'Ford Fusion', 1, 5, 2005, NULL, 4, 2),
(4, '718 Cayman', 5, 6, 2009, NULL, 2, 1),
(5, ' 911 Carrera S', 5, 4, 2000, NULL, 4, 1),
(6, 'Volkswagen Jetta', 6, 6, 2002, NULL, 4, 2);

INSERT INTO `users` (`id`, `password_hash`, `auth_key`, `created_at`, `updated_at`, `username`, `email`, `status`, `id_user_type`) VALUES
(1, '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1558302577, NULL, 'Ivan', 'ivan@mail.ru', 1, 1),
(2, '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1558302577, 155830578, 'sergey', 'sergey@gmail.com', 1, 2),
(3, '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1558302977, NULL, 'anna', 'anna@yandex.ru', 1, 3),
(4, '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1558602977, NULL, 'fedor32', 'fedor32@mail.ru', 1, 4);

INSERT INTO `users_info` (`id`, `id_user`, `surname`, `name`, `middlename`, `birthday`, `telegram_name`, `telephone`, `id_city`) VALUES
(1, 1, 'Петров', 'Сергей', 'Сергеевич', 958727899, '@gentehdj77', '8909912332', 1),
(2, 2, 'Сидоров', 'Игорь', 'Степанович', 327579499, NULL, '8977378287', 3),
(3, 3, 'Марков', 'Павел', NULL, 485342299, '@pavel7872', '8907888261', 1),
(7, 4, 'Ласточкин', 'Степан', 'Аркадьевич', 706267099, '@lastockk88', '8090992377', 6);

INSERT INTO `user_tokens` (`id`, `id_user`, `token`, `expire_time`) VALUES
(1, 1, '53d06bd21c1d40d8b0b4f1a63d051ebf', 1571590898),
(2, 2, 'f89c261c7f271b3a9164523b181ed236', 1568998898),
(3, 3, 'bec09bbfeccd77047c582535bc9868e4', 1568991898),
(4, 4, '744eb5be6f6e6a3e30b3faa7087d7e67', 1563642098);

INSERT INTO `vehicles` (`id`, `id_car_model`, `id_motor`, `power`, `vin`, `reg_number`, `rel_year`, `id_transmission`, `mileage`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 4, 1, 100500, 'LZGCL2R45DX000877', 'x666xx', 2001, 1, 26522, 1, 1558372516, 1, 1558372516),
(2, 1, 1, 23233, 'LZGCR2T60CX054353', 'у389шо', 2000, 1, 234324, 2, 1558372516, 2, 1558372516),
(3, 2, 1, 3500, 'LZGJLDR44DX108040', 'н637щв', 2001, 1, 10000, 3, 1558372216, 1, 1558372616),
(4, 3, 1, 3455, 'LZGJLDR45DX018203', 'т887ло', 2017, 1, 3827, 3, 1558371516, 4, 1558374516);

INSERT INTO `orders` (`id`, `id_city`, `id_vehicle`, `created_by`, `created_at`, `updated_by`, `updated_at`, `id_request_status`, `final_cost`, `complete_date`) VALUES
(1, 1, 1, 1, 1558375773, NULL, 1558375773, 1, NULL, NULL),
(2, 5, 2, 2, 1558375773, NULL, 1558375773, 2, NULL, NULL),
(3, 1, 3, 3, 1558375838, 1, 1558375838, 4, 4900, NULL),
(4, 2, 4, 4, 1558375838, NULL, 1558375838, 3, 6000, NULL);

INSERT INTO `sto_info` (`id`,`id_user`,`name`,`geo`,`rate`,`id_order`,`address`,`telephone`) VALUES
(1, 2,  'test', 'test adress', NULL, NULL, NULL, '8977654123'),
(4, 3, 'Сервис +', 'Ул. Ленина 7/12', NULL, NULL, NULL, '8964556322'),
(9, 1, 'АВТО PRO', 'Проспект мира 21', NULL, NULL, NULL, '8984378287'),
(10, 4,  'Люкс ремонт', 'ул. Героев - панфиловцев 7', NULL, NULL, NULL, '8495333384');

INSERT INTO `service_types` (`id`, `name`, `id_sto`) VALUES
(1, 'Покраска', 1),
(2, 'Мойка', 1),
(3, 'Шиномонтаж', 1),
(4, 'Замена дисков', 1),
(5, 'Уборка салона', 2),
(6, 'Мойка', 2),
(7, 'Ремонт двигателя', 4),
(8, 'Замена масла', 4),
(9, 'Установка дополнительных комплектуюших', 2),
(10, 'Замена свечей зажигания', 3);

INSERT INTO `work_types` (`id`, `name`, `id_service_type`) VALUES
(1, 'Мойка кузова и бонусная уборка салона', 6),
(2, 'Покраска кузова', 1),
(3, 'Замена летних шин на зимние', 3),
(4, 'Новые свечи зажигания', 10);

INSERT INTO `work_categories` (`id`, `name`, `cost`, `id_work_type`) VALUES
(1, 'Замена свечей', 5000, 4),
(2, 'Мойка салона', 1000, 1),
(3, 'Шиномонтажные работы', 4000, 3),
(4, 'Покрасочные работы', 5000, 2);

INSERT INTO `basket` (`id`, `id_service`, `id_work_type`, `id_work_category`, `created_by`, `id_vehicle`, `create_at`, `cost_service`, `id_sto`) VALUES
(1, 1, 2, 4, 1, 1, 1558375586, 3800, 1),
(2, 3, 3, 3, 2, 2, 1558375586, 7000, 4),
(3, 10, 4, 1, 3, 4, 1558375586, 2000, 4),
(4, 3, 3, 3, 4, 3, 1558375586, 3000, 3);

INSERT INTO `vip_cards` (`id`, `number`, `status`, `created_at`, `updated_at`, `id_sto`, `id_user`) VALUES
(3, 168762314, 1, 1558369643, NULL, 1, 1),
(4, 342452545, 1, 1558367643, 1558369643, 4, 2),
(5, 632478368, 1, 1558369643, NULL, 1, 3),
(6, 942451589, 1, 1558367643, 1558369643, 4, 4);

INSERT INTO `bonuses` (`id`, `name`, `size`, `used_count`, `max_count`, `id_vip_card`) VALUES
(1, 'Стандарт', 1000, 876, NULL, 4),
(2, 'Максимум', 5000, 233, NULL, 5),
(3, 'Средний +', 2000, 1700, NULL, 6),
(4, 'Максимум', 5000, 1366, NULL, 5);

INSERT INTO `feedback` (`id`, `created_by`, `id_sto`, `text`, `created_at`, `work_evaluation`, `cost_evaluation`, `service_evaluation`) VALUES
(1, 3, 4, 'Всегда бы так', 1558373665, 5, 5, 5),
(2, 2, 2, 'Порекомендую друзьям обязательно', 1558371765, 5, 5, 5),
(3, 2, 3, 'Очень долго работают', 1558371365, 3, 5, 3),
(4, 4, 3, 'Накручивают цену', 1558371345, 2, 1, 2),
(5, 3, 4, 'Поставил диски по очень выгодной цене', 1558373665, 5, 5, 5),
(6, 2, 2, 'Пожалуй лучший сервис в нашем районе. Всегда оперативно и быстро работают ', 1558371765, 5, 5, 5),
(7, 3, 2, 'Понравилась накопительная система скидок и бонусных карт', 1558371365, 5, 5, 5),
(8, 4, 3, 'Мой вам совет: ни за что на свете не обращайтесь в эту контору', 1558371345, 2, 2, 2);

INSERT INTO `garages` (`id`, `name`, `id_vehicle`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'гараж №1', 1, 1, 1558375989, NULL, NULL),
(2, 'Гараж №2', 2, 2, 1558375989, NULL, NULL),
(3, 'Гараж №3', 3, 3, 1558376034, NULL, NULL),
(4, 'Гараж №4', 4, 4, 1558376034, NULL, NULL);

INSERT INTO `works` (`id`, `id_service`, `id_work_type`, `id_work_category`, `created_by`, `id_vehicle`, `create_at`, `cost_service`, `date_start`, `date_end`, `status`, `id_sto`) VALUES
(1, 2, 1, 2, 3, 1, 1558374261, 2000, 1558374261, 1558374261, NULL, 1),
(2, 2, 1, 2, 2, 2, 1558374271, 2500, 1558374271, 1558384261, NULL, 4),
(3, 2, 1, 2, 1, 4, 1558374261, 2200, 1558374261, 1558374261, NULL, 2),
(4, 2, 1, 2, 4, 3, 1558374271, 2100, 1558374271, 1558384261, NULL, 3),
(9, 1, 2, 4, 3, 4, 1558374261, 5000, 1558374261, 1558374261, NULL, 1),
(10, 1, 2, 4, 2, 2, 1558374271, 4500, 1558374271, 1558384261, NULL, 2),
(11, 1, 2, 4, 1, 4, 1558374261, 2200, 1558374261, 1558374261, NULL, 2),
(12, 2, 1, 2, 4, 3, 1558374546, 6000, 1558374546, 1558374546, NULL, 4);

INSERT INTO `orders_works` (`id`, `id_order`, `id_work`) VALUES
(1, 1, 4),
(2, 2, 11),
(3, 3, 4),
(4, 1, 12),
(5, 4, 4),
(6, 2, 1);