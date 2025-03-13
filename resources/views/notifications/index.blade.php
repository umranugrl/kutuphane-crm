@extends('layouts.admin')
@section('title')
    Notifications
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div style="text-align: right">
                        
                    </div>
                </div>
                <h4 class="card-title">Bildirimler</h4>
                <div class="table-responsive">
                   @foreach ($allNotifications as $notification)
                    <div class="alert @if($notification->read_at)alert-secondary @else alert-success @endif" role="alert">
                        {{ $notification->data['message'] }} 
                        @if(!$notification->read_at)
                            <a href="{{ route('notification.markRead', $notification->id) }}">
                                <button type="button" class="btn btn-dark btn-rounded btn-fw">Okundu olarak işaretle</button>
                            </a>
                        @endif
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
