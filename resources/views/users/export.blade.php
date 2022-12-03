<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th colspan="2"><img src="https://www.ucaldas.edu.co/portal/wp-content/uploads/2017/08/Logo_OscuroU.png"></th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td colspan="2">{{$user->email}}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>