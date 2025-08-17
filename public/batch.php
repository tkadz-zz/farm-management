<?php
ob_start(); 
$title = "Batch Overview"; 
?>
<?php
// Extract arrays for Chart.js
$weights = array_column($batchGrowthLogs, 'averageWeight');
$dates = array_column($batchGrowthLogs, 'date');

$expectedRevenue = $batches[0]['costPerUnit'] * $batches[0]['quantity']
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
              <i class="fa fa-box-open text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-4 mb-xl-0 mb-4">
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
              <i class="fa fa-ranking-star text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-4 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-md-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Prices</p>
              <span class="text-primary text-sm"> 
                <span class=""> $<?= $batches[0]['costPerUnit'] ?> each</span> </span>
              <span class="text-primary text-sm">
                <br><span class="text-primary text-sm">Expected: <span> $<?= $expectedRevenue ?></span></span>
              </span>
            </div>
          </div>
          <div class="col-md-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="fa fa-tag text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-4 mb-xl-0 mb-4">
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
            <div class="icon icon-shape bg-gradient-secondary shadow-success text-center rounded-circle">
              <i class="fa fa-hand-holding-dollar text-lg opacity-10" aria-hidden="true"></i>
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
              <i class="fa fa-sack-dollar text-lg opacity-10" aria-hidden="true"></i>
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
        <div style="height: 200px;" class="table-responsive p-0">
          <table id="saletable" class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
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

                <td class="text-center">
                  <div class="dropdown">
                    <span class="fa fa-ellipsis-h" role="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <!-- Edit -->
                      <li>
                        <a href="#" 
                          class="dropdown-item" 
                          data-bs-toggle="modal" 
                          data-bs-target="#edit_sale_modal_<?= $batchSale['id'] ?>">
                          <i class="fa fa-edit me-2 text-primary"></i>Edit
                        </a>
                      </li>
                      <!-- Delete -->
                      <li>
                        <a href="/delete_sale/<?= $batchSale['id'] ?>/<?= $batchSale['batchID'] ?>" 
                          class="dropdown-item text-danger"
                          onclick="return confirm('Are you sure you want to delete this entry?');">
                          <i class="fa fa-trash me-2"></i>Delete
                        </a>
                      </li>
                    </ul>
                  </div>
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
        <div style="height: 200px;"  class="table-responsive p-0">
          <table class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Loss</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Loss</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reason</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
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
                
                <td class="text-center">
                  <div class="dropdown">
                    <span class="fa fa-ellipsis-h" role="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <!-- Edit -->
                      <li>
                        <a href="#" 
                          class="dropdown-item" 
                          data-bs-toggle="modal" 
                          data-bs-target="#edit_loss_modal_<?= $batchLoss['id'] ?>">
                          <i class="fa fa-edit me-2 text-primary"></i>Edit
                        </a>
                      </li>
                      <!-- Delete -->
                      <li>
                        <a href="/delete_loss/<?= $batchLoss['id'] ?>/<?= $batchLoss['batchID'] ?>" 
                          class="dropdown-item text-danger"
                          onclick="return confirm('Are you sure you want to delete this entry?');">
                          <i class="fa fa-trash me-2"></i>Delete
                        </a>
                      </li>
                    </ul>
                  </div>
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
        
      <div class="card">
        <!-- Tabs -->
        <ul class="nav nav-tabs px-3 pt-2" id="viewTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chart-view" type="button" role="tab">
              Chart View
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-view" type="button" role="tab">
              Table View
            </button>
          </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content p-3" id="viewTabsContent">
          
        <!-- Chart View -->
        <div class="tab-pane fade show active" id="chart-view" role="tabpanel" aria-labelledby="chart-tab">
          <div class="chart">
            <canvas id="chart-lines" class="chart-canvas" height="300"></canvas>
          </div>
        </div>

        <!-- Table View -->
        <div class="tab-pane fade" id="table-view" role="tabpanel" aria-labelledby="table-tab">
          <div style="height: 200px;"  class="table-responsive p-0">
              <table id="growthtable" class="table table-hover align-items-center mb-0 text-center">
                <thead class="text-sm text-secondary">
                <tr>
                  <th>Date</th>
                  <th>Average Weight</th>
                  <th>Notes</th>
                  <th>More</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example rows -->
                <?php foreach (array_reverse($batchGrowthLogs) as $log): ?>
                <tr>
                  <td><?= $log['date']; ?></td>
                  <td><?= $log['averageWeight']; ?> kg</td>
                  <td><?= substr($log['notes'], 0, 15) . (strlen($log['notes']) > 15 ? ' <span data-bs-toggle="tooltip" data-bs-title=" '. $log['notes'] .'" class="text-primary text-sm"> ....more </span>' : ''); ?></td>
                  
                  <td class="text-center">
                    <div class="dropdown">
                      <span class="fa fa-ellipsis-h" role="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <!-- Edit -->
                        <li>
                          <a href="#" 
                            class="dropdown-item" 
                            data-bs-toggle="modal" 
                            data-bs-target="#edit_growth_Log_modal<?= $log['id'] ?>">
                            <i class="fa fa-edit me-2 text-primary"></i>Edit
                          </a>
                        </li>
                        <!-- Delete -->
                        <li>
                          <a href="/delete_growth_log/<?= $log['id'] ?>/<?= $log['batchID'] ?>" 
                            class="dropdown-item text-danger"
                            onclick="return confirm('Are you sure you want to delete this entry?');">
                            <i class="fa fa-trash me-2"></i>Delete
                          </a>
                        </li>
                      </ul>
                    </div>
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
    </div>
  </div>






  <div class="col-md-6">
  <a data-toggle="modal" data-target=".add_health_record_modal" class="btn btn-sm btn-outline-primary text-primary">RECORD HEALTH <span class="fa fa-plus"></span></a>
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Health Records</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div style="height: 200px;"  class="table-responsive p-0">
          <table class="table table-hover align-items-center mb-0">
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costs</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
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
                <td class="text-center">
                  <div class="dropdown">
                    <span class="fa fa-ellipsis-h" role="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <!-- Edit -->
                      <li>
                        <a href="#" 
                          class="dropdown-item" 
                          data-bs-toggle="modal" 
                          data-bs-target="#edit_health_record_modal_<?= $batchHealthRecord['id'] ?>">
                          <i class="fa fa-edit me-2 text-primary"></i>Edit
                        </a>
                      </li>
                      <!-- Delete -->
                      <li>
                        <a href="/delete_health_record/<?= $batchHealthRecord['id'] ?>/<?= $batchHealthRecord['batchID'] ?>" 
                          class="dropdown-item text-danger"
                          onclick="return confirm('Are you sure you want to delete this entry?');">
                          <i class="fa fa-trash me-2"></i>Delete
                        </a>
                      </li>
                    </ul>
                  </div>
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
