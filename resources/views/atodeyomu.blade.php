<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <style>
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links>a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
    }

    table thead th {
      background-color: #eee
    }

    table th,
    table td {
      padding: 10px 0;
      text-align: center;
    }

    table tr:nth-child(even) {
      background-color: #eee
    }
  </style>
</head>

<body>
  <div class="flex-center position-ref full-height">
    <div class="content">
      <h3>
        <span>元記事: </span>
        <a>{{ $url }}</a>
      </h3>
      <h4>引用記事一覧</h4>
      <table>
        <thead>
          <tr>
            <th>タイトル</th>
            <th>URL</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($links as $link)
          <tr>
            <td>仮</td>
            <td>{{ $link }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="m-b-md">
        <hr />
        <p>もっと読む</p>
        <form action="/atodeyomu" method="post">
          @csrf
          <input type="text" name="site-url-input" id="site-url-input" />
          <input type="submit" value="後で読む">
        </form>
      </div>
    </div>
  </div>
</body>

</html>
