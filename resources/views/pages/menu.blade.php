@extends('../layout/' . $layout)

@section('subhead')
    <title>Menu management</title>
@endsection

@section('subcontent')
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <div>
                    <label class="form-label">Menu name</label>
                    <input id="role-name" type="text" name="RoleName" class="form-control" placeholder="Menu name">
                </div>
                <button class="btn btn-primary mt-5">Save</button>
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
@endsection