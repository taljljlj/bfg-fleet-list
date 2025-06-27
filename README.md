## Artwork used (check copyright)

Header image: https://www.instagram.com/warhammer_artwork/p/CSgqAh9t-PD/ \
Body background image: https://civitai.com/user/_Calgar_/images / https://civitai.com/images/7486521

## Setup

Install packages:
```
composer install
npm install
```
Generate app key:
```
php artisan key:generate
```

Run migrations and seed default BFG data:
```
php artisan migrate
php artisan db:seed
```

## Runtime
Necessary for fleet builder functionality:
* For development:
```
npm run dev
```
* For production:
```
npm run build
```
