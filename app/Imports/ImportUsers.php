<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUsers implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row[0],
            'email'    => $row[1],
            'email_verified_at' => $row[2],
            'password' =>   bcrypt($row[3]),
        ]);
    }
}
