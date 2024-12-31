<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados COVID-19</title>
</head>
<body>
    <h1>Dados de Mortes por COVID-19</h1>
    
    @if(isset($erro))
        <p>{{ $erro }}</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>País</th>
                    <th>Casos</th>
                    <th>Mortes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dados as $dado)
                    <tr>
                        <td>{{ $dado['country'] }}</td>
                        <td>{{ $dado['cases'] }}</td>
                        <td>{{ $dado['deaths'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
