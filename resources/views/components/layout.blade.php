<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{mix('css/all.css')}}">
  <script src="https://js.stripe.com/v3/"></script>

  <title>Directory</title>
</head>

<body>
  <x-nav />

  {{$slot}}

  <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>