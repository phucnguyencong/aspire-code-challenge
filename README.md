# About Project
This project allow debtor create new loan with amount and loan term, 
they will repay amount for weekly and creditor could approve loan after
debtor submit
## User case
1. Debtor:
- Request new Loan
- Repay weekly via Loan approve
2. Creditor/Admin:
- Approve Loan for debtors

# How to set up Project
## Clone source code
```shell
git clone https://github.com/phucnguyencong/aspire-code-challenge.git
cd aspire-code-challenge
```

## Setup 
1. Option with shell script
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
