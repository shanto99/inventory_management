@extends('../layout/' . $layout)

@section('subhead')
    <title>Menu management</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add new menu
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <form method="POST" id="menu-form">
                    <input id="menu-id" type="hidden" name="MenuId">
                    <div class="mt-3">
                        <label class="form-label">Menu name</label>
                        <input id="menu-name" type="text"
                        name="Name" class="form-control" placeholder="Menu name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Title</label>
                        <input id="menu-title" type="text"
                        name="Title" class="form-control" placeholder="Menu title">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Icon</label>
                        <input id="menu-icon" type="text"
                        name="Icon" class="form-control" placeholder="Menu icon">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Route name</label>
                        <input id="route-name" type="text"
                        name="RouteName" class="form-control" placeholder="Route name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Permission</label>
                        <select class="form-select sm:mr-2" id="menu-permission" aria-label="Default select example">
                            <option value="" selected>Select permission</option>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @csrf
                    <div class="flex space-x-4">
                        <button id="btn-menu-create" type="submit" class="btn btn-primary mt-5">
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
                            <th class="whitespace-nowrap">Title</th>
                            <th class="text-center whitespace-nowrap">Name</th>
                            <th class="text-center whitespace-nowrap">Route name</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="menu-table-body">
                        @foreach ($menus as $menu)
                            <tr class="intro-x" data-id="{{ $menu->MenuID }}">
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $menu->Title }}</div>
                                </td>
                                <td class="text-center">{{ $menu->Name }}</td>
                                <td class="text-center">{{ $menu->RouteName }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="{{ $menu->MenuID }}"
                                        href="javascript:;" onclick="editMenu(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="{{ $menu->MenuID }}"
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
    <script src="{{ asset('dist/js/menu.js') }}"></script>
@endsection
