@php
  $config = [
      'appName' => config('app.name'),
      'locale' => $locale = app()->getLocale(),
      'locales' => config('app.locales'),
      'githubAuth' => config('services.github.client_id'),
  ];
@endphp
  <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Responsive Admin Dashboard Template">
  <meta name="keywords" content="admin,dashboard">
  <meta name="author" content="stacks">

  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">

  <title>Report</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    body{
      font-family: 'Lato', sans-serif;
      color: #747476;
    }
    .a4-page{
      width: 100%;
      height: 11.7in;
      padding: 20px;
    }
    .company-logo{
      max-width: 3in;
      display: flex;
      align-items: center;
    }
    .company-logo img{
      width: 100%;
    }
    .report-details{
      margin-top: 70px;
      background: rgba(0,0,0,.03);

      width: calc(100% + 40px);
      transform: translateX(-20px);
      padding: 20px;
    }
    .report-details p{
      margin-bottom: 0;
    }
    .item{
      width: 20%;
    }
    .status{
      width: 10%;
    }
    .solution{
      max-width: 200px;
    }
    th.solution{
      text-align: center;
    }
  </style>
</head>
<body>
{{--  {{ dd($report) }}--}}
  <div class="a4-page">
    <div class="d-flex justify-content-between">
      <div class="report-title">
        <h3 class="font-weight-bold">Strategy Overview</h3>
      </div>
      <div class="company-logo">
        <img src="{{ asset('dist/images/cn-logo.png') }}" alt="">
      </div>
    </div>
    <div class="report-details">
      <div class="row">
        <div class="col-2">
          <p>Client Name:</p>
        </div>
        <div class="col-4">
          <p>{{ $report->customer->name }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-2">
          <p>Prepared By:</p>
        </div>
        <div class="col-4">
          <p>Usman</p>
        </div>
      </div>
      <div class="row">

        <div class="col-2">
          <p>Health:</p>
        </div>
        <div class="col-4">
          <p>90%</p>
        </div>
      </div>
      <div class="row">

        <div class="col-2">
          <p>Date:</p>
        </div>
        <div class="col-4">
          <p>02 Feb, 2021</p>
        </div>
      </div>
    </div>


    <div class="row mt-5">
      <div class="col-12">
        @foreach($report->groups as $group)

          <div class="card mt-3">
            <div class="card-header">
              {{ $group->name }}
            </div>
            <div class="card-body">

              <table class="table">
                <thead>
                <tr>
                  <th class="item">Item</th>
                  <th class="status">Status</th>
                  <th class="solution">Solution</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group->reportItems as $item)
                  <tr>
                    <td class="item">
                      {{ $item->groupItem->name }}
                    </td>
                    <td class="status">
                      <span class="badge badge-success">
                        {{ $item->status }}
                      </span>
                    </td>
                    <td class="solution">
                      {{ $item->solution }}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>


{{-- Global configuration object --}}
<script>
  window.config = @json($config);
</script>

{{-- Load the application scripts --}}


</body>
</html>
