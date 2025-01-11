Các Bước Cài Dự án
Bước 1
cp .env.example .env
tạo đb sẵn có, tạo bảng website info với id là 1
bước 2
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
nếu bị lỗi k ánh xạ được ảnh thì xoá storage trong public rồi link lại

