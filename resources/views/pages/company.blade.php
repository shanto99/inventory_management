@extends('../layout/' . $layout)

@section('subhead')
    <title>Company management</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add new company
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-12">
            <div class="intro-y box col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap">Code</th>
                        <th class="text-center whitespace-nowrap">Name</th>
                        <th class="text-center whitespace-nowrap">Address</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody id="menu-table-body">
                    @foreach ($companies as $row)
                        <tr class="intro-x" data-id="{{ $row->CompanyCode }}">
                            <td class="text-center">{{ $row->CompanyCode }}</td>
                            <td class="text-center">{{ $row->CompanyName }}</td>
                            <td class="text-center">{{ $row->Address }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                       data-id="{{ $row->CompanyCode }}"
                                       href="javascript:;" onclick="editCompany(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit/Details </a>
                                    <a class="flex items-center text-theme-6"
                                       href="#" data-id="{{ $row->CompanyCode }}"
                                       onclick="confirmDelete(this)"
                                       data-toggle="modal" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-12">
            <div class="intro-y box p-5">
                <form method="POST" id="company-form">
                    @csrf
                    <input id="Id" type="hidden" name="Id">
                    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                        <div class="col-span-12 lg:col-span-6">
                            <div class="mt-3">
                                <label class="form-label">CompanyCode</label>
                                <input id="CompanyCode" type="text"
                                       name="CompanyCode" class="form-control" placeholder="CompanyCode">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">CompanyName</label>
                                <input id="CompanyName" type="text"
                                       name="CompanyName" class="form-control" placeholder="CompanyName">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Address</label>
                                <input id="Address" type="text"
                                       name="Address" class="form-control" placeholder="Address">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">FactoryAddress</label>
                                <input id="FactoryAddress" type="text"
                                       name="FactoryAddress" class="form-control" placeholder="FactoryAddress">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">ContactPerson</label>
                                <input id="ContactPerson" type="text"
                                       name="ContactPerson" class="form-control" placeholder="ContactPerson">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Phone</label>
                                <input id="Phone" type="text"
                                       name="Phone" class="form-control" placeholder="Phone">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Email</label>
                                <input id="Email" type="text"
                                       name="Email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">VATRegNo</label>
                                <input id="VATRegNo" type="text"
                                       name="VATRegNo" class="form-control" placeholder="VATRegNo">
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-6">

                            <div class="mt-3">
                                <label class="form-label">BIN</label>
                                <input id="BIN" type="text"
                                       name="BIN" class="form-control" placeholder="BIN">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">TIN</label>
                                <input id="TIN" type="text"
                                       name="TIN" class="form-control" placeholder="TIN">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Country</label>
                                <input id="Country" type="text"
                                       name="Country" class="form-control" placeholder="Country">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">IUser</label>
                                <input id="IUser" type="text"
                                       name="IUser" class="form-control" placeholder="IUser">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">IDate</label>
                                <input id="IDate" class="datepicker form-control" data-single-mode="true">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">EUser</label>
                                <input id="EUser" type="text"
                                       name="EUser" class="form-control" placeholder="EUser">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">EDate</label>
                                <input id="EDate" class="datepicker form-control" data-single-mode="true">
                            </div>
                            <div class="mt-3">
                                <label class="form-label"></label>
                                <button id="btn-menu-create" type="submit" class="btn btn-primary mt-5">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('dist/js/company.js') }}"></script>
@endsection
