<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>User deposit</h2>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <form action="{{ route('deposit.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                @error('amount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                <button type="submit" class="btn btn-primary">save</button>
        </form>
    </div>
</body>

</html>