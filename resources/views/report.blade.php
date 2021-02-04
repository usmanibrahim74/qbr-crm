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
    @media print{@page {size: A4 landscape}}
    body{
      font-family: 'Lato', sans-serif;
      color: #747476;
    }
    .a4-page{
      height: calc(8.3in - 40px);
      width: calc(11.7in - 40px);
      padding: 20px;
      border: 2px solid black;
      margin: 20px;
    }
    .report-title{
      font-weight: bold;
      color: #FA5700;
      font-size: 35px;
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
      margin-top: 20px;
      background: rgba(0,0,0,.03);

      width: calc(100% + 40px);
      transform: translateX(-20px);
      padding: 6px 20px;
      display: flex;
    }
    .report-details .left-box{
      flex-basis: 30%;
    }
    .report-details .right-box{
      margin-left: auto;
    }
    .report-details p{
      margin-bottom: 0;
    }
    .report-score{
      width: 60px;
      height: 45px;
      display: flex;
      border-top: 3px solid;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      align-self: center;
      margin: 0 20px;
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
    .group{

    }
    .group .group-header{
      margin: 0 -20px;
      background: #FA5700;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }
    .group .group-header .group-title{
      margin: 0;
    }
    .group .group-header .group-score{
      margin: 0;
    }
    .group .group-body{
      padding-top: 20px;
    }
    .table thead th{
      border-top: none;
      background: rgba(0,0,0,0.2);
      color: gray;
      border-bottom: 4px solid #fff;
      -webkit-print-color-adjust: exact !important;
    }
    .table thead th:not(:last-child){
      border-right: 4px solid #fff;
    }
    .table tbody td{
      border-top: none;
      background-color: rgba(0,0,0,0.2);
      color: gray;
      border-bottom: 4px solid #fff;
      -webkit-print-color-adjust: exact !important;
    }
    .table tbody td:not(:last-child){
      border-right: 4px solid #fff;
    }
    .table .status{
      width: 50px;
      text-align: center;
    }
    .table .item{
      min-width: 180px;
    }
    .table .notes{
      min-width: 180px;
    }
    .table .risk{
      min-width: 180px;
    }
    .table .solution{
      min-width: 180px;
    }
    .table .qtr{
      min-width: 60px;
    }
    .table .year{
      min-width: 100px;
    }
    .table .budget{
      min-width: 100px;
    }
    .table .success{
      background: rgba(0,255,0,0.2);
    }
    .table .status.success{
      background: green;
    }
    .table .info{
      background: rgba(0,0,255,0.2);
    }
    .table .status.info{
      background: blue;
    }

    .table .warning{
      background: rgba(255,69,0,0.2);
    }
    .table .status.warning{
      background: orange;
    }
    .table .danger{
      background: rgba(255,0,0,0.2);
    }
    .table .status.danger{
      background: red;
    }
    .page-break{
      page-break-after: always;
    }

    @media print {

      .table .success{
        background: rgba(0,255,0,0.2) !important;
      }
      .table .status.success{
        background: green !important;
      }
      .table .info{
        background: rgba(0,0,255,0.2);
      }
      .table .status.info{
        background: blue !important;
      }

      .table .warning{
        background: rgba(255,69,0,0.2) !important;
      }
      .table .status.warning{
        background: orange !important;
      }
      .table .danger{
        background: rgba(255,0,0,0.2) !important;
      }
      .table .status.danger{
        background: red !important;
      }

      .table thead th, .table tbody td{
        background-color: rgba(0,0,0,0.2) !important;
        -webkit-print-color-adjust: exact !important;
      }

    }

    /*.table tr:last-child td{*/
    /*  border-bottom: none;*/
    /*}*/
    /*.table.table-borderless th,*/
    /*.table.table-borderless td{*/
    /*  border: none;*/
    /*  background-color: #0f6674;*/
    /*}*/
  </style>
</head>
<body>
{{--  {{ dd($report) }}--}}
  <div class="a4-page">
    <div class="d-flex justify-content-between">
      <h3 class="report-title">
        Strategy Overview
      </h3>
      <div class="company-logo">
        <img src="{{ asset('dist/images/cn-logo.png') }}" alt="">
      </div>
    </div>
    <div class="report-details">
      <div class="left-box">
        <div class="row">
          <div class="col-6">
            <p>Client Name:</p>
          </div>
          <div class="col-6">
            <p>{{ $report->customer->name }}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p>Prepared By:</p>
          </div>
          <div class="col-6">
            <p>Usman</p>
          </div>
        </div>
      </div>
      <div class="right-box">
        <div class="d-flex">
          <div>
            <div class="row">
              <div class="col-4">
                <p>Health:</p>
              </div>
              <div class="col-8">
                <p>90%</p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <p>Date:</p>
              </div>
              <div class="col-8">
                <p>02 Feb, 2021</p>
              </div>
            </div>
          </div>
          <div class="report-score">
            <span>85%</span>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4">
      <div class="col-12">
        <h4 class="font-weight-bold">Excustive Summary</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid atque dolorem enim ex, laboriosam nisi pariatur quae. Ab aliquam dignissimos distinctio doloremque eum fugiat hic illo illum iure laudantium minima, natus omnis perspiciatis, quis quisquam similique sit unde ut, veniam vitae! At aut beatae, distinctio doloremque facere modi officia saepe?</p>
      </div>
    </div>


    @foreach($report->groups as $group)
    <div class="row">
      <div class="col-12">

          <div class="group">
            <div class="group-header">
              <h3 class="group-title">
                {{ $group->name }}
              </h3>
              <p class="group-score">
                Health Score: 70%
              </p>
            </div>
            <div class="group-body">

              <table class="table">
                <thead>
                <tr>
                  <th class="status icon">#</th>
                  <th class="item">service</th>
                  <th class="notes">Notes</th>
                  <th class="risk">Risk</th>
                  <th class="solution">Solution</th>
                  <th class="qtr">Qtr</th>
                  <th class="year">Target Yr.</th>
                  <th class="budget">Budget</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group->reportItems as $item)
                  @php
                    $statusClass = "";
                    if($item->status == "At Risk") $statusClass = "danger";
                    else if($item->status == "Need Attention") $statusClass = "warning";
                    else if($item->status == "Acceptable Risk") $statusClass = "info";
                    else if($item->status == "Satisfactory") $statusClass = "success";
                  @endphp
                  <tr>
                    <td class="status {{ $statusClass }}"></td>
                    <td class="item {{ $statusClass }}">
                      {{ $item->groupItem->name }}
                    </td>
                    <td class="notes {{ $statusClass }}">
                      {{ $item->notes }}
                    </td>
                    <td class="risk {{ $statusClass }}">
                      {{ $item->status }}
                    </td>
                    <td class="solution {{ $statusClass }}">
                      {{ $item->solution }}
                    </td>
                    <td class="qtr {{ $statusClass }}">
                      {{ $item->qtr }}
                    </td>
                    <td class="year {{ $statusClass }}">
                      {{ $item->target_year }}
                    </td>
                    <td class="budget {{ $statusClass }}">
                      {{ $item->budget }}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    @endforeach
  </div>


<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
  window.config = @json($config);
  $(document).ready(function () {
    let h = 0;
    let pageHeight = 796.8;
    let height = pageHeight;
    let iteration = 1;
    let html ="";
    let StartNewPage = true;
    let EndNewPage = false;
    let newPageHeightContained = 0;
    $('.a4-page').children().each(function(i,item){

      if(h + $(item).height() >height){
        if(StartNewPage){
          StartNewPage = false;
          html += '<div class="page-break"></div><div class="a4-page" >';
        }

        if(newPageHeightContained> pageHeight){
          iteration++;
          height = pageHeight*iteration;
          newPageHeightContained = $(item).height();
        }else{
          newPageHeightContained +=$(item).height();
        }

        html += $(item).wrap('<p/>').parent().html();
        $(item).unwrap();
        $(item).remove()



        if(EndNewPage){
          StartNewPage = true;
          EndNewPage = false;
          html += '</div>';
        }

      }else{
        h += $(item).height();
      }
    })
    $('body').append(html)
  })
</script>



</body>
</html>
