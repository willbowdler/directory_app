<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/auth.css')}}">
  <link rel="stylesheet" href="{{asset('css/notes.css')}}">
  <title>Directory</title>
</head>

<body>
  <x-nav />

  {{$slot}}

  <script src="{{asset('js/users/updateSelectedUser.js')}}"></script>

</body>

</html>