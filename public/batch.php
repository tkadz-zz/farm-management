<?php
ob_start(); 
$title = "Batch Overview"; 
?>
<?php
// Extract arrays for Chart.js
$weights = array_column($batchGrowthLogs, 'averageWeight');
$dates = array_column($batchGrowthLogs, 'date');
?>

<div class="row">
  <div class="col-md-3 col-sm-4 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-md-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Batch</p>
              <span class="font-weight-bolder h5">
              <?= $batches[0]['batchName'] ?>
              </span>
              <p class="mb-0">
                <span class="text-primary text-sm font-weight-bolder"><a href="/livestock/<?= $batches[0]['livestockID'] ?>"><?= $batches[0]['livestockName'] ?></a></span>
              </p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-4 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-md-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Quantity</p>
              <span class="text-primary text-sm">
                <span class="font-weight-bolder h5 text-success"><?= $batches[0]['quantity'] - ($batches[0]['sale_quantity'] + $batches[0]['loss_quantity']) ?></span>
                <br>Total In: <span class=" font-weight-bolder"><?= $batches[0]['quantity'] ?></span>
              </span>
            </div>
          </div>
          <div class="col-md-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-4 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-md-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Sold/Lost</p>
              <span class="text-primary text-sm"> 
                <span class="fa fa-arrow-up text-success"><?= $batches[0]['sale_quantity'] ?></span> | <span class="fa fa-arrow-down text-danger"><?= $batches[0]['loss_quantity'] ?></span> </span>
              <span class="text-primary text-sm">
                <br><span class="text-primary text-sm">Total Out: <span class="font-weight-bolder"><?= $batches[0]['sale_quantity'] + $batches[0]['loss_quantity'] ?></span></span>
              </span>
            </div>
          </div>
          <div class="col-md-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <div class="col-md-3 col-sm-4 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-md-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Revenue</p>
              <span class="font-weight-bolder h5">
                $<?= number_format($batches[0]['total_revenue'], 2) ?>
              </span>
              <p class="mb-0">
                <span class="text-danger text-sm font-weight-bolder">Loss: $<?= $batches[0]['estimated_loss'] ?></span>
              </p>
            </div>
          </div>
          <div class="col-md-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row pt-4">
  
  <div class="col-md-6">
  <a data-toggle="modal" data-target=".add_sales_modal" class="btn btn-sm btn-primary text-white">ADD SALE <span class="fa fa-plus"></span></a>
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Sales</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table  id="saletable" class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($batchSales as $batchSale): ?>
              <tr class="text-center">
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchSale['quantity']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">$<?= $batchSale['unitPrice']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">$<?= $batchSale['totalPrice']; ?></p>
                </td>
                <td>
                  <p data-bs-toggle="tooltip" data-bs-title="<?= $batchSale['notes']; ?>" class="text-primary text-xs font-weight-bold mb-0"><span class="fa fa-arrow-pointer"></span> <?= $batchSale['buyerName']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchSale['date']; ?></p>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <div class="col-md-6">
  <a data-toggle="modal" data-target=".add_loss_modal" class="btn btn-sm btn-primary text-white">ADD LOSS <span class="fa fa-plus"></span></a>
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Losses</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Loss</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Loss</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reason</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($batchLosses as $batchLoss): ?>
              <tr class="text-center">
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchLoss['quantity']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">$<?= $batchLoss['unitPrice']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">$<?= $batchLoss['estimatedLoss']; ?></p>
                </td>
                <td>
                  <p data-bs-toggle="tooltip" data-bs-title="<?= $batchLoss['notes']; ?>" class="text-primary text-xs font-weight-bold mb-0"><span class="fa fa-arrow-pointer"></span> <?= $batchLoss['reason']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchLoss['date']; ?></p>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row">

  <div class="col-md-6">
  <a data-toggle="modal" data-target=".add_growth_log_modal" class="btn btn-sm btn-outline-primary text-primary">RECORD GROWTH <span class="fa fa-plus"></span></a>
    <div class="col-md-12 p-2">
      <div class="card card-carousel">
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-lines" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>






  <div class="col-md-6">
  <a data-toggle="modal" data-target=".add_health_record_modal" class="btn btn-sm btn-outline-primary text-primary">RECORD HEALTH <span class="fa fa-plus"></span></a>
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Health Records</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costs</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($batchHealthRecords as $batchHealthRecord): ?>
              <tr class="text-center">
                <td>
                  <p class="text-primary text-xs font-weight-bold mb-0" data-bs-toggle="tooltip" data-bs-title="<?= $batchHealthRecord['notes']; ?>"><span class="fa fa-arrow-pointer"></span> <?= $batchHealthRecord['type']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchHealthRecord['costs']; ?></p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"><?= $batchHealthRecord['date']; ?></p>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  // Pass PHP arrays to JavaScript
  var weights = <?= json_encode($weights) ?>; 
  var dates = <?= json_encode($dates) ?>; 

  var ctx = document.getElementById("chart-lines").getContext("2d");

  new Chart(ctx, {
    type: "line",
    data: {
      labels: dates, // X-axis labels
      datasets: [{
        label: "Average Weight (kg)",
        data: weights, // Y-axis data
        borderColor: "rgba(45, 160, 237, 1)",
        backgroundColor: "rgba(45, 160, 237, 0.2)",
        borderWidth: 2,
        tension: 0.4, // Smooth curves
        fill: true,
        pointRadius: 4,
        pointBackgroundColor: "#2d9cdb",
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: true, // No transition animation
      plugins: {
        legend: {
          position: "top",
          labels: {
            font: {
              size: 12,
              family: "Open Sans"
            }
          }
        },
        title: {
          display: true,
          text: "Growth Rate Over Time"
        }
      },
      scales: {
        y: {
          beginAtZero: false
        }
      }
    }
  });
</script>

<?php $content = ob_get_clean(); require __DIR__ . '/../components/layouts/layout-auth.php'; ?>
