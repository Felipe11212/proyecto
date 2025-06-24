<!DOCTYPE html>
<html>
<head>
    <title>Ingreso Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Código de Administrador</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.verificar') }}">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código Secreto</label>
            <input type="password" name="codigo" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>

</body>
</html>
