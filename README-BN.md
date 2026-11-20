# Glow Basket BD — Professional Laravel Starter

এটি Glow Basket BD-এর জন্য একটি পেশাদার-স্টাইলের bilingual Laravel 12 storefront starter।

## এতে যা আছে
- Responsive storefront: mobile, tablet, desktop
- বাংলা ও ইংরেজি কনটেন্ট
- পণ্য তালিকা, সার্চ, পণ্য বিস্তারিত
- Session-based shopping cart
- Checkout ও Cash on Delivery অর্ডার
- অর্ডার নম্বর তৈরি
- Admin login, order dashboard এবং order status update
- SQLite দিয়ে প্রাথমিকভাবে চালানোর ব্যবস্থা

## লাইভ করার আগে অবশ্যই
1. `.env.example` কপি করে `.env` বানান।
2. `APP_KEY` তৈরি করুন: `php artisan key:generate`
3. `ADMIN_EMAIL` এবং শক্তিশালী `ADMIN_PASSWORD` বদলান।
4. `APP_DEBUG=false` রাখুন।
5. `APP_URL` আপনার প্রকৃত HTTPS ডোমেইন দিন।
6. `database/database.sqlite` তৈরি করুন এবং `php artisan migrate --seed` চালান।
7. ওয়েব সার্ভারের document root অবশ্যই `public/` হবে।
8. নমুনা পণ্যের নাম, ছবি, দাম ও বিবরণ নিজের প্রকৃত পণ্য দিয়ে বদলান।

## ইনস্টল
প্রয়োজন: PHP 8.2+, Composer, PDO SQLite extension, Laravel-compatible hosting.

```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
```

Admin: `/admin`  
Store: `/`

## সীমাবদ্ধতা / পরবর্তী উন্নয়ন
এটি সম্পূর্ণ hosted/production-audited commerce system নয়। লাইভে নেওয়ার আগে hosting, backups, email/SMS notifications, courier integration, stock management, product CRUD, privacy/terms pages, security review এবং বাস্তব পণ্যের তথ্য যোগ করতে হবে। bKash/Nagad/card payment gateway এখানে যুক্ত করা হয়নি। ডেলিভারি চার্জ বর্তমানে উদাহরণ হিসেবে ৳70।


## bKash / Nagad manual payment
Checkout now includes Cash on Delivery, bKash manual, and Nagad manual choices. For wallet orders, the customer can enter sender number and transaction ID; the admin order view displays those details for manual verification. This is NOT an API/automatic payment gateway. Before enabling wallet payment for real customers, configure and publish your verified business/merchant receiving numbers and clear payment instructions, then verify each transaction in the official merchant account. Until then, keep Cash on Delivery as the available payment method. Never ask customers for PIN or OTP.
