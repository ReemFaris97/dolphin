@servers(['web' => 'alqabedah@alqabedah.com'])

@task('deploy')
    cd /home/alqabedah/dolphin
    git pull origin Develop
    php artisan config:Cache
@endtask
@task('beta')
    cd /home/alqabedah/beta.alqabedah.com/public_html
    git pull origin Develop
    php artisan config:Cache
    composer install
    php artisan migrate
@endtask

@task('seed_storage')
    cd /home/alqabedah/dolphin
  php artisan db:seed UpdateProductsTableSeeder
@endtask
