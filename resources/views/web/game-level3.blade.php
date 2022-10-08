@extends('web.layouts.app')

@section('content')
    <main class="px-3">
        <div class="card color-black">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </main>
@endsection
@section('javascript')
<script>
    window.onload = function (){
        $(document).ready(function(){
            // alert('ide gas');
        });
    }
</script>
@endsection
