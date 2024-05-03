<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/scss/common/reset.scss'])
  @yield('style')
  @yield('js')
  <title>@yield('title')</title>
</head>
<body>
  <main>
    <article>
      <section>
        @yield('content')
      </section>
    </article>
  </main>
</body>
</html>