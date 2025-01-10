@props([
    'doctitle' => __( 'Scribe CMS' ),
    'bodyClass' => ''
])

@pushOnce('adminStyles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
<link rel="stylesheet" href="{{ url( 'admin/assets/css/admin.css' ) }}" />
@endpushOnce

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<title>{{ $doctitle }}</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

@stack('adminStyles')
@stack('adminScripts')
</head>

<body @class( $bodyClass )>
<div class="wrap">
    {{ $slot }}
</div>
</body>

</html>
