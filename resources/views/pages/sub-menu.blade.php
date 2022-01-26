@extends('../layout/' . $layout)

@section('subhead')
    <title>Sub menu management</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add new sub menu
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <form method="POST" id="menu-form">
                    <input id="sub-menu-id" type="hidden" name="MenuSubID">
                    <div class="mt-3">
                        <label class="form-label">Title</label>
                        <input id="menu-title" type="text"
                        name="Title" class="form-control" placeholder="Sub menu title">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Name</label>
                        <input id="menu-name" type="text"
                        name="Name" class="form-control" placeholder="Sub menu name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Menu</label>
                        <select class="form-select sm:mr-2" id="parent-menu" aria-label="Default select example">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->MenuID }}">{{ $menu->Title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Route name</label>
                        <input id="route-name" type="text"
                        name="RouteName" class="form-control" placeholder="Route name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Permission</label>
                        <select class="form-select sm:mr-2" id="menu-permission" aria-label="Default select example">
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
                            <th class="text-center whitespace-nowrap">Menu</th>
                            <th class="text-center whitespace-nowrap">Route</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="menu-table-body">
                        @foreach ($subMenus as $subMenu)
                            <tr class="intro-x" data-id="{{ $subMenu->MenuSubID }}">
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $subMenu->Title }}</div>
                                </td>
                                <td class="text-center">{{ $subMenu->Name }}</td>
                                <td class="text-center">
                                    {{ $subMenu->menu->Title }}
                                </td>
                                <td class="text-center">{{ $subMenu->RouteName }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="{{ $subMenu->MenuSubID }}"
                                        href="javascript:;" onclick="editSubMenu(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="{{ $subMenu->MenuSubID }}"
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
    <script src="{{ asset('dist/js/subMenu.js') }}"></script>
@endsection
