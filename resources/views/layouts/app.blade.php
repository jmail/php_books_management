<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Books Management') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- fontawsome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Toastr -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
<div id="app">
    <nav style="border-radius: 0px !important;" class="navbar navbar-inverse">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/books') }}">
                {{ __('Books Management') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Toastr -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function confirmDelete(id) {
        event.preventDefault()
        swal({
            title: "{{__('Confirmation Delete')}}",
            text: "{{__('Are you sure want to Delete this Book?')}}",
            type: "success",
            buttons: {
                confirm: {
                    text: "{{__('Ok')}}",
                },
                cancel: {
                    text: "{{__('Cancel')}}",
                    visible: true,
                }
            }
        }).then(function (isConfirm) {
            if (isConfirm) {
                document.getElementById('delete_form-' + id).submit();
            }
        });
    }

    var options = {"closeButton": true, "positionClass": "toast-top-right", "progressBar": true,};
    @if(count($errors))
        @foreach($errors->all() as $error)
         toastr.error("{{ $error }}", '', options);
        @endforeach
    @endif

    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}", '', options);
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}", '', options);
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}", '', options);
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}", '', options);
            break;
    }
    @endif

    @if(count($errors))
    $('#createBookModal').modal('show');
    @endif
</script>
@yield('js')
</body>
</html>
