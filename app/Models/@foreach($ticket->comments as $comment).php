@foreach($ticket->comments as $comment)
                            <div class="panel panel">
                             
                                    {{ $comment->user->name }}
                                    <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="panel panel-body">
                                    {{ $comment->comment_name }}
                                </div>
                            </div>
                        @endforeach