@extends('../layout/' . $layout)

@section('subhead')
    <title>Permission management</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add new Permission
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <form method="POST" id="permission-form" action="{{ route('permission') }}">
                    <input id="permission-id" type="hidden" name="PermissionId">
                    <div>
                        <label class="form-label">Permission name</label>
                        <input id="permission-name" type="text"
                        name="Name" class="form-control" placeholder="Permission name">
                    </div>
                    @csrf
                    <div class="flex space-x-4">
                        <button id="btn-permission-create" type="submit" class="btn btn-primary mt-5">
                            Add
                        </button>
                        <button id="btn-edit-cancel" class="btn btn-warning mt-5 invisible">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-8">
            <div class="intro-y box col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Permission</th>
                            <th class="text-center whitespace-nowrap">Count</th>
                            <th class="text-center whitespace-nowrap">Created at</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="permission-table-body">
                        @foreach ($permissions as $permission)
                            <tr class="intro-x" data-id="{{ $permission->id }}">
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $permission->name }}</div>
                                </td>
                                <td class="text-center">86</td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center text-theme-6"> 2022-01-01 </div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="{{ $permission->id }}"
                                        href="#" onclick="editPermission(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="{{ $permission->id }}"
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('dist/js/permission.js') }}"></script>
@endsection
