<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="favicon.png">

  <title>

    {{ env("APP_NAME") }}
    @isset($page_title) -{{$page_title}} @endisset

  </title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="Andrew Tan">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">

</head>

<body>

  @yield("content")

  <script src="/js/app.js"></script>
</body>

</html>