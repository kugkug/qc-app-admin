@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    List of Users
                </h3>
            </div>
            <div class="card-body">
                {{-- <x-information /> --}}
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Occupation</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle"> {{ ucwords($user['lastname']. " " .$user['firstname'] . ", " .$user['middlename'] )}} </td>
                                            <td class="align-middle"> {{$user['occupation']}} </td>
                                            <td class="align-middle"> {{$user['email']}} </td>  
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>