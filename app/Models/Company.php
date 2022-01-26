<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $connection = "sqlsrv2";
    protected $table = "tblCompany";

    protected $primaryKey = "CompanyCode";
    public $incrementing = false;

    protected $guarded = [];
    public $timestamps = false;
}
