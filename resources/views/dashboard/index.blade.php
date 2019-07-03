@extends('body')

<!--Article css, in the future it's mine-->
@section('css')
    <style>
        input[type=text]
        {
            /* background: #fff !important;
            margin-top: 0.2rem !important;
            margin-bottom: 0 !important;
            border: 1px solid lightgray !important;
            padding-left: 0.5rem !important;
            border-radius:2em !important;
            text-decoration: underline !important;
            transition: all .2s ease-out !important; */
            height: 30px !important;
            
            text-align: center;

            text-decoration:none !important;

            border-bottom: 1px dotted black !important;
        }

        /* input[type=text]::selection,  */
        input[type=text]:active, input[type=text]:focus 
        {
            /* background:#f4f4f4 !important;
            border-radius:0.2rem !important; */
            
        }

        .input-sku {
            width: 125px !important;
        }

        .input-color {
            width: 65px !important;
        }

        .photo-box:not(:first-child) {
            border-top:1px solid #e1e1e1;
        }

        .panel-padding {
            /* margin:0 -0.3em -1em 0; */
            /* padding-left:0.2em; */
            color: black;
        }

        .panel-padding::after { content: "__"; }

        .flex-height {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endsection

@section('content')
    <!--Main loop-->
    <div class="row">
        <div class="col m12">
            <h5 class="center-align">Groups name</h5>
            <div class="card-panel lightgrey lighten-5 z-depth-0" style="padding:0.5em 0 0.5em 0">
                
                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')

                @include('dashboard.panel')
            </div>

        </div>
    </div>

    <footer class="page-footer transparent">
        <div class="">
            <div class="row flex-height">
                <div class="col s12 m6">
                    <div class="left black-text">
                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active"><a href="#!">1</a></li>
                            <li class="waves-effect"><a href="#!">2</a></li>
                            <li class="waves-effect"><a href="#!">3</a></li>
                            <li class="waves-effect"><a href="#!">4</a></li>
                            <li class="waves-effect"><a href="#!">5</a></li>
                            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="right black-text" style=margin-top:1em>
                        <a class="waves-effect waves-light btn-small btn-flat green white-text" style="width:125px;border-radius:2em;"><i class="material-icons left">done</i> บันทึก</a>
                    </div>
                </div>
            </div>
        </div>
        
    </footer>
            
          
@endsection

@section('js')
    <script>
        
    </script>
@endsection