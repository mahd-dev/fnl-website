# fnl-website

## Usage:

1. Copy this repo to your server:

```bash
git clone git@github.com:mahdCompany/fnl-website.git
```

2. Import the SQL file FNL-database.sql into your database server:

```bash
sed -i 's~http://fnl.tn~/http://YOUR-DOMAIN.TLD~/g' /path/to/FNL-database.sql # WP store hardcoded URLs in the DB
mysql db-user -p db-name < /path/to/FNL-database.sql
```
3. copy the wp-config-sample.php to wp-config.php

configure your wp-config.php to match your database server config

4. change the two first lines of wp-options to match your server URL
