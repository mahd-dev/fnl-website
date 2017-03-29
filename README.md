# fnl-website

## Usage:

1. Copy this repo to your server:

```bash
$ git clone git@github.com:mahdCompany/fnl-website.git
```

2. Import the SQL file FNL-database.sql into your database server:

```bash
$ sed -i 's~http://fnl.tn~/http://YOUR-DOMAIN.TLD~/g' /path/to/FNL-database.sql # WP store hardcoded URLs in the DB
$ mysql db-user -p db-name < /path/to/FNL-database.sql
$ mysql -u user -p -e 'INSERT INTO `wp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_status`)
VALUES ('newadmin', MD5('mYstrongPassword'), 'firstname lastname', 'email@example.com', '0');
INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
VALUES (NULL, (Select max(id) FROM wp_users), 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}');
INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
VALUES (NULL, (Select max(id) FROM wp_users), 'wp_user_level', '10');' db-name # Will create a new SuperAdmin user called "newadmin" and have "mYstrongPassword" as password
```
3. copy the wp-config-sample.php to wp-config.php

configure your wp-config.php to match your database server config

4. change the two first lines of wp-options to match your server URL
