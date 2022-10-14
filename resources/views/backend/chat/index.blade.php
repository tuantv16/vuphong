@extends('backend.dashboard')

	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<style>
		.parent0 {
			color: red
		}
	</style>
	<script type="text/javascript" src="{{ asset('js/backend/main_category.js') }}"></script>
	<script>
      $(document).ready(function() {
          $('#category').DataTable();
      });
    </script>
	
@section('content')

<div class="row fontText">
	<div class="col-md-12 flash-message">
           @foreach (['danger', 'warning', 'success', 'info'] as $msg)
               @if(Session::has('alert-' . $msg))
                   <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
               @endif
           @endforeach
    </div> <!-- end .flash-message -->
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Quản lý Chat</h3>
		</div>
	</div>
	<div class="col-md-12">
        <div class="tile">
            <fieldset id="backend_chat_realtime">
                <legend>Backend chat realtime</legend>
                <br>
                <div id="content_demo_chat">
                    @if(!empty($dataChat))
                        @foreach($dataChat as $chat)
                            <p class='message'><b>{{$chat->username}} : </b>{{ $chat->message }}</p>
                        @endforeach
                    @endif
                </div>
        
                <input id="message_demo_chat" placeholder="Write something..">
                <br>
                <input type="hidden" id="admin_reply" value="admin_tuantv"/>
                <button id="backend_sendMessage_demo_chat">Admin send</button>
            </fieldset>
        
            
        </div>
    </div>
   
    
 </div>
@stop
