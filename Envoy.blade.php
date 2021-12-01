@servers(['web' => 'alqabedah@alqabedah.com'])

@task('deploy')
    cd /home/alqabedah/dolphin
    git stash
    git pull origin Develop
    composer install
    php artisan migrate
    php artisan config:Cache
@endtask

@task('seed_storage')
    cd /home/alqabedah/dolphin
  php artisan db:seed UpdateProductsTableSeeder
@endtask
