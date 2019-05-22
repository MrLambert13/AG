CREATE SCHEMA autogigant CHARACTER SET utf8 COLLATE utf8_bin;

####Create geo table
`php yii migrate/create create_currency_table --fields=name:string:notNull,code:integer`  

`php yii migrate/create create_countries_table --fields="name:string:notNull,id_currency:integer:foreignKey(currency)"`  

`php yii migrate/create create_regions_table --fields="name:string:notNull,description:text,id_country:integer:foreignKey(countries)"`  

`php yii migrate/create create_cities_table --fields="name:string:notNull,timezone:tinyInteger,id_region:integer:foreignKey(regions)"`  

___
#### Create users table

`php yii migrate/create create_user_types_table --fields=name:string:notNull`  

`php yii migrate/create create_users_table --fields="password_hash:string:notNull,auth_key:string,created_at:integer:notNull,updated_at:integer,username:string(32):notNull:unique,email:string(128):notNull:unique,status:boolean,id_user_type:integer:foreignKey(user_types)"`  

`php yii migrate/create create_users_info_table --fields="id_user:integer:notNull:foreignKey(users),surname:string:notNull,name:string:notNull,middlename:string,birthday:integer:notNull,telegram_name:string,telephone:string(10):notNull:unique,id_city:integer:notNull:foreignKey(cities)"`  

`php yii migrate/create create_user_tokens_table --fields="id_user:integer:notNull:foreignKey(users),token:string,expire_time:integer,id_user_type:integer:foreignKey(user_types),"`  
___
#### Create car tables  
`php yii migrate/create create_car_brands_table --fields=name:string:notNull && php yii migrate/create create_car_equips_table --fields=name:string:notNull` 
 
`php yii migrate/create create_car_types_table --fields=name:string:notNull && php yii migrate/create create_car_gens_table --fields=name:string:notNull`  

`php yii migrate/create create_car_models_table --fields="name:string:notNull,id_car_brand:integer:notNull:foreignKey(car_brands),id_car_equip:integer:notNull:foreignKey(car_equips),year_from:year:notNull,year_to:year,id_car_gen:integer:notNull:foreignKey(car_gens),id_car_type:integer:notNull:foreignKey(car_types)"`  

`php yii migrate/create create_transmissions_table --fields=name:'ENUM(\"АКПП-гидро\", \"АКПП-робот\", \"АКПП-вариатор\", \"МКПП\")'`  

`php yii migrate/create create_motors_table --fields=name:'ENUM(\"бензин\", \"дизель\", \"электро\", \"гибрид-газ\", \"гибрид-электро\")'`  

`php yii migrate/create create_vehicles_table --fields="id_car_model:integer:notNull:foreignKey(car_models),id_motor:integer:notNull:foreignKey(motors),power:integer,vin:string(17),reg_number:string(7),rel_year:integer,id_transmission:integer:foreignKey(transmissions),mileage:integer,created_by:integer:notNull:foreignKey(users),created_at:integer:notNull,updated_by:integer:notNull:foreignKey(users),updated_at:integer:notNull"`  
___
#### Create orders tables  
`php yii migrate/create create_request_statuses_table --fields=name:'ENUM(\"Создана\",\"В работе\",\"Приостановлена\",\"Выполнена\")'`  

`php yii migrate/create create_orders_table --fields="id_city:integer:notNull:foreignKey(cities),id_vehicle:integer:notNull:foreignKey(vehicles),created_by:integer:notNull:foreignKey(users),created_at:integer:notNull,updated_by:integer:foreignKey(users),updated_at:integer:notNull,id_request_status:integer:notNull:foreignKey(request_statuses),final_cost:double,complete_date:integer"`  
___
####STO
`php yii migrate/create create_sto_info_table --fields="id_user:integer:notNull:foreignKey(users),name:string:notNull,geo:string,rate:integer,id_order:integer:foreignKey(orders),address:string,telephone:string(10):notNull:unique"`
___
####Others
`php yii migrate/create create_garages_table --fields="name:string:notNull,id_vehicle:integer:foreignKey(vehicles),created_by:integer:notNull:foreignKey(users),created_at:integer:notNull,updated_by:integer:foreignKey(users),updated_at:integer"`  

`php yii migrate/create create_feedback_table --fields="created_by:integer:foreignKey(users),id_sto:integer:foreignKey(users),text:text,created_at:integer,work_evaluation:tinyInteger,cost_evaluation:tinyInteger,service_evaluation:tinyInteger"`  

`php yii migrate/create create_service_types_table --fields="name:integer:notNull,id_sto:integer:foreignKey(users)"`  
`php yii migrate/create create_work_types_table --fields="name:string:notNull,id_service_type:integer:foreignKey(service_types)"`  
`php yii migrate/create create_work_categories_table --fields="name:string:notNull,cost:double:notNull,id_work_type:integer:foreignKey(work_types)"`  

`php yii migrate/create create_basket_table --fields="id_service:integer:foreignKey(service_types),id_work_type:integer:foreignKey(work_types),id_work_category:integer:foreignKey(work_categories),created_by:integer:foreignKey(users),id_vehicle:integer:foreignKey(vehicles),create_at:integer:notNull,cost_service:double:notNull,id_sto:integer:foreignKey(users)"`  

`php yii migrate/create create_orders_works_table --fields="id_order:integer:foreignKey(orders),id_work:integer:foreignKey(works)"`  
`php yii migrate/create create_vip_cards_table --fields="number:integer:notNull,status:boolean,created_at:integer:notNull,updated_at:integer,id_sto:integer:foreignKey(users),id_user:integer:foreignKey(users)"`  
`php yii migrate/create create_bonuses_table --fields="name:string:notNull,size:double:notNull,used_count:integer,max_count:integer,id_vip_card:integer:foreignKey(vip_cards)"`  

