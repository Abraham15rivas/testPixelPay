<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test PixelPay</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
            
            <div class="content">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card card-new">
                                <div class="card-header text-center vino">Administración de tareas</div>
                
                                <div class="card-body">
                
                                    <task-component/>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
