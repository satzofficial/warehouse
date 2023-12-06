{{-- @if (Session::has('error'))
<div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4" role="alert">
    <p class="font-bold">
        {{ session::get('error') }}
    </p>
</div>
@endif

@if (Session::has('success'))
<div class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4" role="alert">
    <p class="font-bold">
        {{ session::get('success') }}
    </p>
</div>
@endif --}}


{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>                
            @endforeach
        </ul>
    </div>
@endif  --}}

<script>
    console.log(toastr);
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif


    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
