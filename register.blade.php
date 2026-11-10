<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	@vite('resources/css/app.css')
</head>
<body>
<form action="{{ route('register') }}" method="POST">
    @csrf
<div>
    <input type="text" name="name" id="name" value="{{ old('name') }}">
</div>
<div>
    <input type="email" name="email" id="email" value="{{ old('email') }}">
</div>
<div>
    <input type="text" name="no_tlpn" id="no_tlpn" value="{{ old('no_tlpn' ) }}">
</div>
<div>
    <input type="password" name="password" id="password">
</div>
<div>
    <select name="role" id="role">
        <option value="pemilik" @selected(old('role') == 'pemilik')>Pemilik</option>
        <option value="penyewa" @selected(old('role') == 'penyewa')>Penyewa</option>
    </select>
</div>
<div>
    <button type="submit" class="">Register</button>
</div>
</form>
</body>
</html>
