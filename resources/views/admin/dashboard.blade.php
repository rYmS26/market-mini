<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis consequuntur, ut perferendis sint autem debitis ratione unde eligendi fugiat esse deserunt totam, nisi fuga deleniti odio est hic cum. Omnis.</p>
    <form action="{{ route('admin.actionlogout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
</body>
</html>