<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="h-100 d-flex align-items-center">
  <div class="container shadow rounded-3" style="width: 60%">
    <div class="row">
      <div class="col-6 rounded-3" style="background-image: url('image/unud.jpeg'); background-repeat:no-repeat; background-size:cover">
      </div>
      <form class="col-6 p-4" action="{{route('post.login')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nim" class="form-label" style="font-size: 0.9rem">NIM</label>
          <input type="text" class="form-control" id="nim">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label" style="font-size: 0.9rem">Password</label>
          <input type="password" class="form-control" id="password">
        </div>
        <div class="container-fluid d-flex justify-content-between p-0 mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault"  style="font-size: 0.9rem">
               Ingat Saya
            </label>
          </div>
            <a href="" style="font-size: 0.9rem">Yahaha Lupa Password ?</a>
        </div>
        <div class="container-fluid d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>