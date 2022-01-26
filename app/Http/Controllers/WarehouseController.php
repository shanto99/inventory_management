<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function warehouseSetup()
    {
        $companies = Warehouse::all();
        return view('pages/warehouse', [
            'companies' => $companies
        ]);
    }

    public function createWarehouse(Request $request) {
        $warehouseData = $request->all();
        $isUpdate = false;
        if(isset($warehouseData['IDate']) && $warehouseData['IDate']) {
            $warehouseData['IDate'] = Carbon::parse($request->IDate)->format('Y-m-d');
        }
        if(isset($warehouseData['EDate']) && $warehouseData['EDate']) {
            $warehouseData['EDate'] = Carbon::parse($request->EDate)->format('Y-m-d');
        }

        $warehouse = Warehouse::find($warehouseData['WarehouseCode']);

        if($warehouse) {
            $warehouse->update($warehouseData);
            $warehouse = Warehouse::find($warehouseData['WarehouseCode']);
            $isUpdate = true;
        } else {
            $warehouse = Warehouse::create($warehouseData);
        }

        return response()->json([
            'warehouse' => $warehouse,
            'isUpdate' => $isUpdate,
            'status' => 200
        ], 200);
    }


    public function deleteWarehouse($id)
    {
        $warehouse = Warehouse::find($id);
        if ($warehouse) {
            $warehouse->delete();
        }

        return response()->json([
            'message' => 'Warehouse deleted successfully',
            'status' => 200
        ], 200);
    }

    public function warehouseDetails($warehouseCode)
    {
        $warehouse = Warehouse::find($warehouseCode);
        $warehouse->IDate = date('d M, Y',strtotime($warehouse->IDate));
        $warehouse->EDate = date('d M, Y',strtotime($warehouse->EDate));
        return response()->json([
            'warehouse' => $warehouse,
            'status' => 200
        ], 200);
    }
}
