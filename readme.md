1. Extract zip file to apache www folder
2. Execute below command to add vendor folder of dependencies using composer
$ php composer.phar install
3. execute script using below command
$ php robot.php --floor=hard/carpet --area=60/70
3. check log messages in logs folder. each execution will create new log file.