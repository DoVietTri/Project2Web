@extends('client.master')
@section('title', 'Liên hệ')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Liên hệ</h2>
                </div>
            </div>          
        </div>
    </div>
</div>

<div style="margin-top: 50px" class="row">
    <div class="col-md-6">
        <form action="{!! route('postContact') !!}" method="POST">
            {{ csrf_field() }}
            <div class="form-group" style="margin:0 auto; width: 70%">
                <label>Phản hồi</label>
                <textarea rows="8" cols="70" placeholder="Viết tin nhắn phản hồi vào đây..." name="txtMessage"></textarea>
            </div>
            <button style="margin: 10px 500px; width: 10% " class="btn btn-primary">Gửi</button>
        </form>
    </div>
    <div class="col-md-6">
        <h2>Bản đồ nằm đây</h2>

        
    </div>
</div>
@endsection