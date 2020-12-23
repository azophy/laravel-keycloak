<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
<div class="container">
  <form action="/login" method="POST">
    @csrf
    <h1>Login</h1>

    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="email">Email</label>
    <input type="text" id="email" name="email" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" />

    <button type="submit">Login</button>
  </form>

</div>
</body>
</html>
