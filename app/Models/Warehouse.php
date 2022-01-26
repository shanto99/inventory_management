<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $connection = "sqlsrv2";
    protected $table = "tblWarehouse";

    protected $primaryKey = "WarehouseCode";
    public $incrementing = false;

    protected $guarded = [];
    public $timestamps = false;
}
