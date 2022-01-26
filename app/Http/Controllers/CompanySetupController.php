<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanySetupController extends Controller
{
    public function companySetup()
    {
        $companies = Company::all();
        return view('pages/company', [
            'companies' => $companies
        ]);
    }

    public function createCompany(Request $request) {
        $companyData = $request->all();
        $isUpdate = false;
        if(isset($companyData['IDate']) && $companyData['IDate']) {
            $companyData['IDate'] = Carbon::parse($request->IDate)->format('Y-m-d');
        }
        if(isset($companyData['EDate']) && $companyData['EDate']) {
            $companyData['EDate'] = Carbon::parse($request->EDate)->format('Y-m-d');
        }

        $company = Company::find($companyData['CompanyCode']);

        if($company) {
            $company->update($companyData);
            $company = Company::find($companyData['CompanyCode']);
            $isUpdate = true;
        } else {
            $company = Company::create($companyData);
        }

        return response()->json([
            'company' => $company,
            'isUpdate' => $isUpdate,
            'status' => 200
        ], 200);
    }


    public function deleteCompany($id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
        }

        return response()->json([
            'message' => 'Company deleted successfully',
            'status' => 200
        ], 200);
    }

    public function companyDetails($companyCode)
    {
        $company = Company::find($companyCode);
        $company->IDate = date('d M, Y',strtotime($company->IDate));
        $company->EDate = date('d M, Y',strtotime($company->EDate));
        return response()->json([
            'company' => $company,
            'status' => 200
        ], 200);
    }
}
