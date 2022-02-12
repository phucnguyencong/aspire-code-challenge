<?php

namespace App\Repositories\Eloquent;

use App\Models\Loan;
use App\Repositories\Interfaces\LoanRepositoryInterface;

class LoanRepository implements LoanRepositoryInterface {

    /**
     * Create a new record in table Loan
     *
     * @param array $data
     * @return App\Models\Loan
     */
    public function create(array $data): Loan
    {
        return Loan::create($data);
    }

    /**
     * Update to table Loan via ID
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Loan::where("id", $id)->update($data);
    }

    /**
     * Find loan with ID
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return Loan::find($id);
    }
}
