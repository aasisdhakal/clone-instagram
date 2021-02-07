FROM gcr.io/pvstaging/nginx-php7-fpm:7.2-stage
ADD ./docker/sites/default-live.conf /etc/nginx/sites-enabled/default
ADD ./docker/conf/supervisord.conf /supervisord.conf
RUN cat /supervisord.conf >> /etc/supervisor/conf.d/supervisord.conf
WORKDIR /var/www
ADD ./ /var/www/
RUN composer install --no-dev && composer du -o
RUN touch /var/www/storage/logs/laravel.log
RUN chown -Rf www-data.www-data /var/www/
EXPOSE 80
ENTRYPOINT ["/bin/bash","/start.sh"]

