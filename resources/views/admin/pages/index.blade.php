@extends('admin.masterAdmin')

@section('contentAdmin')

  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Đơn hàng mới</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{!! $order !!}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng doanh thu tháng {{ date('m') }}</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> {!! number_format($money, 0, ",", ".") !!} VNĐ</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng số người dùng</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{!! $user !!}</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Liên hệ từ khách hàng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $contact_new }} <span style="color: blue;">new</span></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu tháng</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div id="total-month" data-total-month="{{ $totalMonth }}" class="chart-area">
            <canvas id="myLineChart" height="120px"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Biểu đồ trạng thái đơn hàng</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div id="listOrder" class="chart-pie pt-4 pb-2" data-list-order="{{ $statusTransaction }}">
                    <canvas id="myCircleChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Chờ xử lý
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Đã xử lý
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Đang giao hàng
                    </span>
                  </div>
                </div>
              </div>
            </div>
  </div>
<script type="text/javascript">

  var total = $('#total-month').attr('data-total-month');

  total = JSON.parse(total);

  var bienx = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
  var CHART = document.getElementById('myLineChart').getContext('2d');
  var line_chart = new Chart(CHART, {
    type: 'line',
    data: {
      labels: bienx,
      datasets: [{
        label: "Doanh thu tháng",
        data: total
      }]
    },
  });

</script>

<script>

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myCircleChart");
var listOrder = $("#listOrder").attr('data-list-order');
listOrder = JSON.parse(listOrder);
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Chờ xử lý", "Đang giao hàng", "Đã xử lý"],
    datasets: [{
      data: listOrder,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>



@endsection

