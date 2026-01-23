<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div style="margin: auto;margin-top: 20%;width: 40%;">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                   {{session('error')}}
                </div>
            @endif
            <form action="{{route('forget.password.post')}}" method="post" autocomplete="off" >
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Place Your Email" required style="border:1px solid green;">
                <br>
                <input type="submit" class="btn btn-primary" value="CHECK">
            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
