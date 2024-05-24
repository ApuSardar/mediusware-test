<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposited Transactions</title>
</head>

<body>
    <h1>Deposited Transactions</h1>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $deposit)
            <tr>
                <td>{{ $deposit->created_at }}</td>
                <td>${{ number_format($deposit->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>