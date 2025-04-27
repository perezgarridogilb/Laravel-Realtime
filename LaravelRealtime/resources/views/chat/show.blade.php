@extends('layouts.app')

@push('styles')
<style type="text/css">
    #users > li {
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Game</div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh;">
                                    </ul>
                                </div>
                            </div>
                            <form action="" class="">
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input type="text" id="message" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <button id="send" type="submit" class="btn btn-primary btn-block" style="width: 100%;">Send</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <p><strong>Online Now</strong></p>
                            <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh;">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script> <!-- Pusher debe cargarse primero -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.iife.js"></script> <!-- Luego carga Echo -->

<script>

function greetUser(id) 
        {
            window.axios.post('/chat/greet/' + id);    
        }
</script>
@endpush