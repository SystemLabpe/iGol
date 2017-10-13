INSERT INTO `igoldb`.`roles`(`name`,`created_at`,`updated_at`)VALUES
('customer','2017-10-01 00:00:00','2017-10-01 00:00:00'),
('venue admin','2017-10-01 00:00:00','2017-10-01 00:00:00');


INSERT INTO `igoldb`.`venues`(`name`,`address`,`phone`,`latitude`,`longitude`,`day_price`,`night_price`,`img`,`parking`,`play_area`,`created_at`,`updated_at`) VALUES
('Palomino Soccer11','Calle 123','989072130',-12.070548,-76.940011,60.00,90.00,'',1,0,'2017-10-01 00:00:00','2017-10-01 00:00:00'),
('Campo Bonigol','Calle 456','996139063',-12.026694,-77.040284,60.00,90.00,'',1,1,'2017-10-01 00:00:00','2017-10-01 00:00:00'),
('Campo Deportivo Ricardo Bentín','Calle 789','--',-12.029583,-77.038260,60.00,90.00,'',1,1,'2017-10-01 00:00:00','2017-10-01 00:00:00');

COMMIT;
