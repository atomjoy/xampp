# Use Custom Domain Instead of localhost in XAMPP

Xampp local domain example.org virtualhost with SSL for apache and Laravel.

## Windows add local host for example.org domain

Open file as administrator **C:\Windows\System32\drivers\etc\hosts** and append hosts

```sh
# Local domains
127.0.0.11 example.org www.example.org
127.0.0.12 app.xxx www.app.xxx
127.0.0.13 db.xx www.db.xx
```

## Create directory for domain and index.php file

```sh
# Domain dir
D:/www/example.org/public

# Apache index.php file with
# <?php echo "works ...";
D:/www/example.org/public/index.php
```

## Xampp Apache config 

Include config files directory add in **xampp/apache/conf/extra/httpd-vhosts.conf**

```sh
Include "conf/extra/vhosts/*.conf"
```

## Xampp Apache Virtualhost

Add in **xampp/apache/conf/extra/vhosts/example.org.conf**

```sh
<VirtualHost 127.0.0.11:80>
    DocumentRoot "D:/www/example.org/public"
    DirectoryIndex index.php
    ServerName example.org
    ServerAlias www.example.org

    ErrorLog "D:/www/example.org/storage/logs/example.org.error.log"
    CustomLog "D:/www/example.org/storage/logs/example.org.access.log" common

    # Redirect to https
    #RewriteEngine On
    #RewriteCond %{HTTPS} off
    #RewriteRule (.*) https://%{SERVER_NAME}$1 [R,L]

    <Directory "D:/www/example.org/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride all
        Order Deny,Allow
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost 127.0.0.11:443>
    DocumentRoot "D:/www/example.org/public"
    ServerName example.org
    ServerAlias www.example.org

    SSLEngine on
    SSLCertificateFile "conf/ssl.crt/server.crt"
    SSLCertificateKeyFile "conf/ssl.key/server.key"

    <Directory "D:/www/example.org/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride all
        Order Deny,Allow
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>
```

## Restart Apache

Restart Xampp Apache server from xampp panel or restart Windows.

## Run xampp server and website

Accept invalid SSL for domain in (advanced button).

<https://example.org>

