@foreach($comment as $comments)
                                                    <tr>
                                                        <td>{{ $comments->ticket->ticket_name }}</td>
                                                    </tr>
                                                @endforeach