@extends('../layout/' . $layout)

@section('subhead')
    <title>All users</title>
@endsection

@section('subcontent')
    @if(isset($action) && $action == "add")
        @include('../../layout/components/user-form')
    @else
        @include('../../layout/components/allusers')
    @endif 
@endsection

@section('script')
    <script src="{{ asset('dist/js/users.js') }}"></script>
@endsection
