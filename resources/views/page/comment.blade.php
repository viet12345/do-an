					@foreach($comment as $hi)
					
					<div class="media">
	                   	    <div class="media-body">
		                        <h4 class="media-heading">{{$hi->name_user}}
		                            <small>{{$hi->created_at}}</small>
		                        </h4>
		                      <p> {{$hi->content}}</p>
		                    </div>
	                	</div>
	                @endforeach 

	                