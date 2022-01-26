    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            All users
        </h2>
    </div>
    <a href="users/add" class="btn btn-primary mt-5">Add user</a>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 md:col-span-12 lg:col-span-8">
            <div class="intro-y box col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Name</th>
                            <th class="text-center whitespace-nowrap">Designation</th>
                            <th class="text-center whitespace-nowrap">Email</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="role-table-body">
                        @foreach ($users as $user)
                            <tr class="intro-x">
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $user->UserName }}</div>
                                </td>
                                <td class="text-center">{{ $user->Designation }}</td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center text-theme-6"> {{ $user->Email }} </div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        href="{{ route('edit-user', ['id' => $user->UserID]) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="{{ $user->UserID }}"
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
