@servers(['web' => 'alqabedah@alqabedah.com'])

@task('deploy')
    cd /home/alqabedah/dolphin
    git pull origin Develop
    composer install
    php artisan migrate
    php artisan config:Cache
@endtask
