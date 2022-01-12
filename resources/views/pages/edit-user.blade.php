@extends('../layout/' . $layout)

@section('subhead')
    <title>Edit user</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Edit user
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                @include('../../layout/components/user-form')
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('dist/js/role.js') }}"></script> --}}
@endsection
