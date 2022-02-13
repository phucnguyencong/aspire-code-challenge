## About Project
This project allow debtor create new loan with amount and loan term, 
they will repay amount for weekly and creditor could approve loan after
debtor submit
### User case
1. Debtor:
- Request new Loan
- Repay weekly via Loan approve
2. Creditor/Admin:
- Approve Loan for debtors

## Setup up Project

### Clone source code
```shell
git clone https://github.com/phucnguyencong/aspire-code-challenge.git
cd aspire-code-challenge
```

### Setup 
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
php artisan passport:install
```

### Start application
```shell
php artisan serve
```

## Run test
1. Migrate data before run test
```shell
php artisan db:seed
```
2. Run test with command
```shell
php artisan test
```
follow [this link](https://laravel.com/docs/8.x/testing) for more information run test
