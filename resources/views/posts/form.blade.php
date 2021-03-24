

@if($errors->any())
    <div class="alert alert-dismissible alert-danger">
            @foreach($errors->all() as $error)
                <p><b> {{ $error }}</b></p>
            @endforeach
    </div>
@endif