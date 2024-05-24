<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        {{Auth::user()->name}}
        <p>This is your dashboard where you can manage your account and view important information.</p>
        <a class="btn btn-success" href="{{route('deposit.index')}}">Deposit</a>
        <a class="btn btn-primary" href="{{route('withdraw.index')}}">Withdrawl</a>
        <a class="btn btn-primary" href="{{url('withdrawal')}}">Show Withdrawl</a>
        <a class="btn btn-primary" href="{{url('deposit')}}">Show Deposit</a>
    </div>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transanctions as $data)
            <tr>
                <td>{{$data['type']}}</td>
                <td>{{$data['amount']}}</td>
                <td>{{$data['balance_after']}}</td>
            </tr>
            @endforeach

    </table>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>