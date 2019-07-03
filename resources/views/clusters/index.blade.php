@extends('body')

<!--Article css, in the future it's mine-->
@section('css')
    <style>
        
    </style>
@endsection

@section('content')

    <div class="row" style=margin-top:1em>
        <div class="col m12 center-align">
            <a data-target="modal1" class="waves-effect waves-light modal-trigger btn-small white-text" style="width:145px;border-radius:2em;background:#12ab87"><i class="material-icons left">add</i> สร้างรายการ</a>
        </div>
    </div>
    
    <!--Cluster content-->
    <div data-role=clusters>
        <div data-role=sub-cluster>
            <div data-role=cluster-header>
                <p class="flow-text grey-text">แผนก B-me</p>
            </div>
            <div data-role=cluster-body class="row">
                @include('clusters.card', ['text' => 'งานถ่ายแบบ Wacoal Mood 13/07/2561 รอบที่ 2', 'n' => 34 ])

                @include('clusters.card')

                @include('clusters.card')
            </div>
        </div>
    </div>

     <!--Modal Structure-->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" ><i class="material-icons left" style=color:#12ab87>done</i> Saves</a>
        </div>
    </div>
  
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, null);
        });

    </script>
@endsection