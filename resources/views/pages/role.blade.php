@extends('../layout/' . $layout)

@section('subhead')
    <title>Role management</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add new role
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <form method="POST" action="{{ route('role') }}">
                    <div>
                        <label class="form-label">Role name</label>
                        <input id="role-name" type="text" name="Name" class="form-control" placeholder="Role name">
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary mt-5">Save</button>
                </form>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Role</th>
                            <th class="text-center whitespace-nowrap">Count</th>
                            <th class="text-center whitespace-nowrap">Created at</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="intro-x">
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $role->name }}</div>
                                </td>
                                <td class="text-center">86</td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center text-theme-6"> 2022-01-01 </div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
