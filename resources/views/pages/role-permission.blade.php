@extends('../layout/' . $layout)

@section('subhead')
    <title>Role management</title>
@endsection

@section('subcontent')
     
 <div class="overflow-x-auto">
     <table class="table">
         <thead>
             <tr>
                 <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Permissions</th>
                 @foreach($roles as $role)
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">{{ $role['name'] }}</th>
                 @endforeach
             </tr>
         </thead>
         <tbody>
             @foreach ($permissions as $permission)
                <tr>
                    <td class="border-b dark:border-dark-5">{{ $permission['name'] }}</td>
                    @foreach($roles as $role)
                        <td class="border-b dark:border-dark-5">
                            <input data-role-id="{{ $role['id'] }}" 
                              data-permission-id="{{ $permission['id'] }}" 
                              @if(in_array($permission['id'], $role['permissionIdChecked'])) checked @endif
                              onclick="assignPermissionToRole(this)" 
                              class="form-check-input" type="checkbox">
                        </td>
                    @endforeach
                </tr>
             @endforeach
         </tbody>
     </table>
@endsection

@section('script')
    <script src="{{ asset('dist/js/rolePermission.js') }}"></script>
@endsection
