<form method="POST" id="role-form" action="{{ route('create-user') }}">
    <div class="mt-3">
        <label class="form-label">User ID</label>
        <input type="text" required
        @if(isset($user)) readonly value="{{ $user->UserID }}" @endif 
        name="UserID" class="form-control" placeholder="User ID">
    </div>
    <div class="mt-3">
        <label class="form-label">Name</label>
        <input id="user-name" type="text" required
        @if(isset($user)) value="{{ $user->UserName }}" @endif
        name="UserName" class="form-control" placeholder="User name">
    </div>
    <div class="mt-3">
        <label class="form-label">Designation</label>
        <input id="user-designation" type="text" required
        @if(isset($user)) value="{{ $user->Designation }}" @endif
        name="Designation" class="form-control" placeholder="User designation">
    </div>
    <div class="mt-3">
        <label class="form-label">Email</label>
        <input id="user-email" type="text" required
        @if(isset($user)) value="{{ $user->Email }}" @endif
        name="Email" class="form-control" placeholder="User email">
    </div>
    <div class="mt-3">
        <label class="form-label">Roles</label>
        <select name="Roles[]" id="user-roles" data-placeholder="Give roles" class="tom-select w-full" multiple>
            @foreach ($roles as $role)
                <option @if(isset($user) && in_array($role->id, $user->roleIds)) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select> 
    </div>
    <div class="mt-3">
        <label class="form-label">Permissions</label>
        <select name="Permissions[]" id="user-roles" data-placeholder="Give permissions" class="tom-select w-full" multiple>
            @foreach ($permissions as $permission)
                <option @if(isset($user) && in_array($permission->id, $user->permissionIds)) selected @endif value="{{ $permission->id }}">{{ $permission->name }}</option>
            @endforeach
        </select> 
    </div>
    <div class="mt-3">
        <label class="form-label">Password</label>
        <input type="text"
        name="Password" class="form-control" placeholder="Password">
    </div>
    @csrf
    <div class="flex space-x-4">
        <button id="btn-role-create" type="submit" class="btn btn-primary mt-5">
            @if(isset($user)) Update @else Add @endif
        </button>
    </div>
</form>