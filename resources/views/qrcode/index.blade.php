<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code Generator</title>
</head>
<body>
    <h1>QR Code Generator</h1>
    <form action="{{ route('qrcode.generate') }}" method="post">
        @csrf
        <label for="station">Station:</label>
        <input type="text" name="station" id="station">
        <br>
        <button type="submit">Generate QR Code</button>
    </form>
</body>
</html>