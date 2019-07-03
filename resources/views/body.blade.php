<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!--Main character set-->
        <meta charset="utf-8" />
        
        <!--Main viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="{{ asset('/materialize-css/dist/css/materialize.min.css') }}"  media="screen,projection" />

        <!--Meta Title-->
        <title>Photo Renaming</title>

        <!--Extends javascript-->
        @yield('css')

    </head>
    <body>
        <!--Main headers-->
        @include('headers')
        
        <!--Main content-->
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!--Main footer-->

        <!--Modal path-->
        
        <!--Extension script-->

        <!--jQuery for ui-->
        <script type="text/javascript" src="{{ asset('/jquery/dist/jquery.min.js') }}"></script>

        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="{{ asset('/materialize-css/dist/js/materialize.min.js') }}"></script>

        <!--Body Script (Script ที่รัน without การ caching ใดๆ)-->
        <script>
            
        </script>

        <!--Extends javascript-->
        @yield('js')
    </body>
</html>
