@extends('layouts.app')

@section('content')

<style>
#tblNotifications tbody tr{
    background-color: #fff3cd;
}
#tblNotifications tbody tr.isRead{
    background-color: #fff;
}

#tblNotifications tbody tr:hover{
    cursor: pointer;
}
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Notifications</h3>
                    <!-- <a href='#' class="btn btn-normal float-right"><i class="fas fa-plus"></i> Create Player</a> -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="alert alert-warning" role="alert" style="display:none">
                        New notification detected. Click this <a href="/notifications" class="alert-link">link</a> to load the new notification.
                    </div>
 


                    <div class="table-responsive">
                        <table class="table table-bordered table-striped global-table text-center w-100" id="tblNotifications">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Player Info</th>
                                    <th>Description</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $notificationsCount = 0;
                                @endphp
                                @foreach($notifications as $notification)
                                    <tr
                                    @if($notification->is_read == 1)
                                        class="isRead"
                                    @else
                                        class="new" data-id="{{ $notification->id }}"
                                    @endif
                                    >
                                        <td>{{ ++$notificationsCount }}</td>
                                        <td>{{ $notification->type }}</td>
                                        <td>{{ $notification->black_list->bad_first_name }} {{ $notification->black_list->bad_middle_name }} {{ $notification->black_list->bad_last_name }}</td>
                                        <td>{{ $notification->description }}</td>
                                        <td>{{ date("M d, Y h:i:s a",strtotime($notification->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>   
                    </div>  
                    

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("document").ready(function(){
        // $('.new').on('click', () => {
        $(document).on('click', '.new', function(){
            let id = $(this).data('id');
            readNotification(id);
            $(this).removeClass('new').addClass('isRead');
        })
    });

    const readNotification = async (id) => {
        let response = await axios.put('/api/v1/notifications/read/' + id);
    }
</script>
@endsection