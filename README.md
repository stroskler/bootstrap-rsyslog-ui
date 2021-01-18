<h1>bootstrap-rsyslog-ui</h1>

![Screenshot](https://raw.githubusercontent.com/hmsdao/bootstrap-rsyslog-ui/master/images/main.PNG)
![Login](https://github.com/stroskler/bootstrap-rsyslog-ui/blob/master/images/login-site.png)

Installation
---
* Configure rsyslog according to (you can skip installation of LogAnalyzer): http://tecadmin.net/setup-rsyslog-with-mysql-and-loganalyzer/
* git clone "https://github.com/hmsdao/bootstrap-rsyslog-ui.git" /var/www/html/bootstrap-rsyslog-ui
* Copy /var/www/html/bootstrap-rsyslog-ui/config-template.php to /var/www/html/bootstrap-rsyslog-ui/config.php
* Edit config.php and correct mysql settings accordingly

Create login database schema
---
```
# Create database 'login'
create database login;

# Create table for the accounts
CREATE TABLE `user_account_table` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_logon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

Automating chart cache
---
* The charts are now based on cached json-files instead of querying the database each time the charts are drawned.
* This means you need to schedule a timer job each day.
* Example for crontab line (crontab -e):
``` 
  5 0 * * * cd /var/www/html/maintenance; ./generate_reports_cache.sh
```

Database Maintenance
---
* Make sure you have set variable $keep_logs_for_days in config.php
* Example for crontab line (crontab -e):
```
  1 0 * * * cd /var/www/html/maintenance; /usr/bin/php ./db-maintenance.php
```

ToDo's
---
* improve automation
* docker image
* review code


Enjoy!
