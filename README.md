# About Project
This project allow debtor create new loan with amount and loan term, 
they will repay amount for weekly and creditor could approve loan after
debtor submit
## User case
1. Debtor:
- Request new Loan
- Repay weekly via loan was approved
2. Creditor/Admin:
- Approve Loan for debtors

# Workflow and explain
- I am build project based service-repository pattern
The concept of repositories and services ensure that you will reusable code and help to keep
your controller as simple as possible making theme more readable.

1. When a request from client to server will follow:
Controller -> Validator -> Service -> Repository -> Model
- Repositories are usually a common wrapper for your model and the place where you would 
write different queries in your database. Sometimes we will use Query Builder in repository
because when handle with big data and using Laravel relationship or complex query condition
is nightmare for performance. Just make sure using it suitable for context
- A service on the other hand is a layer for handling all your application’s logic
- I don't want controller handle too many tasks. That is why I break Validator to new layer so
we could reuse later
2. When get data and response to client will follow:
Model -> Repository -> Service -> Transformer -> Controller
- Based on experience, transformers give you the flexibility to create a format for
JSON response that you need. By using transformers we can also do type casting, 
pagination results, and also nest relationships.

# How to set up Project
## Prerequisites
- PHP >=7.4
- Composer

## Clone source code
```shell
git clone https://github.com/phucnguyencong/aspire-code-challenge.git
cd aspire-code-challenge
```

## Setup 
Note: 
- Make sure extension solidum enable in PHP ini

1. Option with shell script (work well on MacOS, Linux OS)
```shell
sh ./shell/setup.sh
```

2. Option manual step
```shell
touch database/database.sqlite
cp .env.example .env
```
Make sure change before continue
```DB_DATABASE=/absolute/path/to/database.sqlite```

```shell
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
```

## Start application
```shell
php artisan serve
```

# Postman
1. Import collection and environment inside folder postman. Follow [link](https://learning.postman.com/docs/getting-started/importing-and-exporting-data/#importing-data-into-postman)
2. We are using two role Creditor/Debtor for this project, so that after login with then you should update
access_token_creditor/access_token_debtor in Postman Environment

# Run test
1. Run Feature test
```shell
php artisan test --testsuite=Feature
```
2. Run Unit test
```shell
php artisan test --testsuite=Unit
```
3. Run all testsuite
```shell
php artisan test
```
follow [this link](https://laravel.com/docs/8.x/testing) for more information run test
