

# php-mvc
Php ile kodlamayı kolaylaştırmak için oluşturulan br mvc şablonudur 

Örnek kullanım ./index.php dosyasında mevcuttur.

Düzgün çalışması için bütün requestler index.php dosyasına yönlendirilmelidir. 

## apache için mod_rewrite ile yapılabilir.
Örnek

    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /index.php?path=$1 [NC,L,QSA]

Kaynak: [https://stackoverflow.com/a/18406686/4546246](https://stackoverflow.com/a/18406686/4546246)

## nginx için config dosyası ile yapılmalıdır.

    location / {
        set $page_to_view "/index.php";
        try_files $uri $uri/ @rewrites;
        root   /var/www/site;
        index  index.php index.html index.htm;
    }
    
    location ~ \.php$ {
        include /etc/nginx/fastcgi_params;
        fastcgi_pass  127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME /var/www/site$page_to_view;
    }
    
    # rewrites
    location @rewrites {
        if ($uri ~* ^/([a-z]+)$) {
            set $page_to_view "/$1.php";
            rewrite ^/([a-z]+)$ /$1.php last;
        }
    }

Kaynak: [https://stackoverflow.com/a/12931128/4546246](https://stackoverflow.com/a/12931128/4546246)

## VestaCP kullanıyorsanız web template'i wordpress2_rewrite yapmanız yeterlidir.

Aşağıdaki nginx config dosyası çalışan bir VestaCP örneğidir

    server {
        listen      192.168.0.18:80;
        server_name phpmvc.com www.phpmvc.com;
        root        /home/admin/web/phpmvc.com/public_html;
        index       index.php index.html index.htm;
        access_log  /var/log/nginx/domains/phpmvc.com.log combined;
        access_log  /var/log/nginx/domains/phpmvc.com.bytes bytes;
        error_log   /var/log/nginx/domains/phpmvc.com.error.log error;
        location = /favicon.ico {
            log_not_found off;
            access_log off;
        }
    
        location = /robots.txt {
            allow all;
            log_not_found off;
            access_log off;
        }
    
        location / {
            try_files $uri $uri/ /index.php?$args;
            
            if (!-e $request_filename)
            {
                rewrite ^(.+)$ /index.php?q=$1 last;
            }
    
            location ~* ^.+\.(jpeg|jpg|png|gif|bmp|ico|svg|css|js)$ {
                expires     max;
            }
    
            location ~ [^/]\.php(/|$) {
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                if (!-f $document_root$fastcgi_script_name) {
                    return  404;
                }
    
                fastcgi_pass    127.0.0.1:9002;
                fastcgi_index   index.php;
                include         /etc/nginx/fastcgi_params;
            }
        }
    
        error_page  403 /error/404.html;
        error_page  404 /error/404.html;
        error_page  500 502 503 504 /error/50x.html;
    
        location /error/ {
            alias   /home/admin/web/phpmvc.com/document_errors/;
        }
    
        location ~* "/\.(htaccess|htpasswd)$" {
            deny    all;
            return  404;
        }
    
        location /vstats/ {
            alias   /home/admin/web/phpmvc.com/stats/;
            include /home/admin/web/phpmvc.com/stats/auth.conf*;
        }
    
        include     /etc/nginx/conf.d/phpmyadmin.inc*;
        include     /etc/nginx/conf.d/phppgadmin.inc*;
        include     /etc/nginx/conf.d/webmail.inc*;
    
        include     /home/admin/conf/web/nginx.phpmvc.com.conf*;
    }

