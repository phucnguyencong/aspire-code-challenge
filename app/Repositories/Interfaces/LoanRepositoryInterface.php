<?php

namespace App\Repositories\Interfaces;

use App\Models\Loan;

interface LoanRepositoryInterface {
    public function create(array $data): Loan;
    public function update(int $id, array $data): bool;
    public function find(int $id);
}
