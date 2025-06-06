# Local domains with SSL in Xampp

Xampp virtual hosts for your domain or subdomain with SSL on Apache2 and Laravel.

## Windows add local host for app.test domain

Open file as administrator **C:\Windows\System32\drivers\etc\hosts** and append hosts

```sh
# Local domain
127.0.0.10 app.test www.app.test

# Next domain
# 127.0.0.11 example.com www.example.com
```

## Create directory for domain and index.php file

```sh
# Domain dirs
D:/web/localhost
D:/web/app.test/public

# Apache index.php file with
# <?php echo "works ...";
D:/web/localhost/index.php
D:/web/app.test/public/index.php
```

## Xampp Apache config 

Include config files directory add in **xampp/apache/conf/extra/httpd-vhosts.conf**

```sh
Include "conf/extra/vhosts/*.conf"
```

## Xampp Apache Virtualhost

Add in **xampp/apache/conf/extra/vhosts/app.test.conf**

```sh
<VirtualHost 127.0.0.10:80>
    DocumentRoot "D:/web/app.test/public"
    DirectoryIndex index.php
    ServerName app.test
    ServerAlias www.app.test

    ErrorLog "D:/web/app.test/storage/logs/app.test.error.log"
    CustomLog "D:/web/app.test/storage/logs/app.test.access.log" common

    # Redirect to https
    #RewriteEngine On
    #RewriteCond %{HTTPS} off
    #RewriteRule (.*) https://%{SERVER_NAME}$1 [R,L]

    <Directory "D:/web/app.test/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride all
        Order Deny,Allow
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost 127.0.0.10:443>
    DocumentRoot "D:/web/app.test/public"
    ServerName app.test
    ServerAlias www.app.test

    SSLEngine on
    SSLCertificateFile "conf/ssl.crt/server.crt"
    SSLCertificateKeyFile "conf/ssl.key/server.key"

    <Directory "D:/web/app.test/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride all
        Order Deny,Allow
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>
```

## Restart Apache and browser

Restart Xampp Apache server from xampp panel or restart Windows.

## Run xampp server and website

Accept invalid SSL for domain in (advanced button).

<https://app.test>

## Testing

Change app.test to a domain with dns mx records (for email testing in Laravel: app.test).
