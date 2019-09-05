<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Vitaly Kasymov">
        <meta name="description" content="">

        <title>{{ env('APP_NAME_FORMATTED') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="/images/brand.png" />

        <script>
            window.roi_global = {!! json_encode([
                'appName'   => env('APP_NAME_FORMATTED'),
                'siteUrl'   => config('app.url'),
                'apiUrl'    => config('app.url') . '/api'
            ]) !!};
        </script>
    </head>
    <body>
        <div id="app" v-cloak></div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
