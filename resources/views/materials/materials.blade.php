@extends('layouts.app')

@section('content')
    <div>
        <form id="file-form" method="post" enctype="multipart/form-data">
            @csrf
            <label for="material">Add Materials</label>
            
            <input id="material" name="material" type="file" class="hidden"/></form>
        <a href="">Delete Materials</a>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#material').on('change',function() {
                var fileData = document.getElementById('file-form');
                var formData = new FormData(fileData);
                $.ajax({
                    type:'POST',
                    data: formData,
                    
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: '{{route('addmaterial')}}',
                    success: function(response) {
                        alert(response);
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                })
            });
        })
    </script>
@endsection