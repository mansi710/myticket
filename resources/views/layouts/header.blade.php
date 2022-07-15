<html>
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </head>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{route('dashboard')}}">Ticket System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
            
             
                <li class="nav-item">
                    @can('isUser')
                        <a class="nav-link" href=" {{route('tickets.index')}}">List Of Tickets</a>
                    @endcan
                    @can('isAdmin')
                      <a class="nav-link" href=" {{route('adminTicketList')}}">List Of Tickets</a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('isUser')
                    <a class="nav-link" href=" {{route('changePassword.index')}}">Change Password</a>
                    @endcan
                </li>

                <li class="nav-item">
                    <a class="nav-link" href=" {{route('profilePage')}} ">Profle Page</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href=" {{route('getListOfNotifications')}} ">Notification List </a>
                </li>

                </ul>


            </div>
            <div>
                <div>{{Auth::user()->name}}

                    
                     
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                       
                
                </div>
            </div>

           
        </nav>

        @yield('content')

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          
    </html>