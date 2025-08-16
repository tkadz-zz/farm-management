
<?php
ob_start(); 
$title = "Dashboard"; 
?>
<?php
// Sample $batches array (fetched from controller)
$batches = $batches ?? []; // Ensure it's defined

// Dashboard summary calculations
$totalBatches = count($batches);
$totalLivestockTypes = count(array_unique(array_column($batches, 'livestockID')));
$totalUsers = count(array_unique(array_column($batches, 'createdBy')));

$totalQuantity = array_sum(array_column($batches, 'quantity'));
$totalCurrent = array_sum(array_column($batches, 'current_quantity'));
$totalLosses = array_sum(array_column($batches, 'total_losses'));
$totalSales = array_sum(array_column($batches, 'total_sales'));


$total_revenue = array_sum(array_column($batches, 'total_revenue'));
$total_loss_value = array_sum(array_column($batches, 'total_loss_value'));
?>



<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Livestock</p>
              <span class="font-weight-bolder h5">
                <?php echo $totalLivestockTypes; ?>
              </span>
              <p class="mb-0">
                <span class="text-primary text-sm font-weight-bolder"><a href="#!">View</a></span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Batches</p>
              <span >
                <Span class="font-weight-bolder h5"><?= $totalBatches ?></Span> | 
                <span class="text-sm font-weight-bolder"><?= $totalCurrent ?>/<?= $totalQuantity ?></span>
              </span>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder"><a href="#!">View</a></span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Sold/Lost</p>
              <span> <span class="fa fa-arrow-up text-success"><?= $totalSales ?></span> | <span class="fa fa-arrow-down text-danger"><?= $totalLosses ?></span> </span>
              <p class="mb-0">
                <a href="#!" class="text-danger text-sm font-weight-bolder">View</a>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Revenue</p>
              <span class="font-weight-bolder h5">
                $<?= number_format($total_revenue, 2) ?>
              </span>
              <p class="mb-0">
                <span class="text-danger text-sm font-weight-bolder">Loss: $<?= $total_loss_value ?></span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
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

  <div class="col-md-6 p-2">
    <div class="card card-carousel">
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="chart-pie" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 p-2">
    <div class="card card-carousel">
      <div class="card-body p-3">
        <div class="chart">
            <canvas id="salesLossesChart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  
</div>


<div class="row pt-4">
      <div class="col-md-8 pt-2">
      <a data-toggle="modal" data-target=".add_batch_modal" class="btn btn-sm btn-outline-primary">ADD BATCH <span class="fa fa-plus"></span></a>
        <div class="card mb-4">
          <div class="card-body">
            <div class="card-header pb-0">
              <h6>Available Batches</h6>
            </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="dataTable" class="table table-hover table-striped align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batch ID / Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Livestock</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($batches as $batch): ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm"><?= $batch['batchName'] ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $batch['livestockName'] ?> - <?= $batch['category'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class=""><?= $batch['current_quantity'] ?>/<?= $batch['quantity'] ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d/m/y', strtotime($batch['created_at'])) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d/m/y', strtotime($batch['expected_at'])) ?></span>
                    </td>
                    <td class="align-middle">
                      <a href="/batch/<?= $batch['id'] ?>" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        <span class="fa fa-computer-mouse"></span> View
                      </a>
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

    <div class="col-md-4 pt-2">
    <a data-toggle="modal" data-target=".add_new_livestock_modal" class="btn btn-sm btn-outline-primary">NEW LIVESTOCK <span class="fa fa-plus"></span></a>
      <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Livestock - <span class="font-weight-bold text-sm rounded p-1 "><?= count($livestock) ?></span></h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
            <?php foreach ($livestock as $livestock_role): ?>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="fa fa-cow text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm"><?= $livestock_role['livestockName'] ?> - <span class=""><?= $livestock_role['category'] ?></span> </h6>
                      <span class="text-xs"> <?= $livestock_role['activeBatchCount'] ?> batch<?php if($livestock_role['activeBatchCount'] > 1): echo 's'; ?><?php endif; ?> of <?= $livestock_role['livestockName'] ?> </span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <a href="./livestock/<?= $livestock_role['id'] ?>" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                  </div>
                </li>
            <?php endforeach; ?>
              </ul>
            </div>
          </div>
      </div>


</div>


  <script>
    var total_revenue = <?= $total_revenue ?>; //
    var total_loss_value = <?= $total_loss_value ?>;
    
    const ctx = document.getElementById('salesLossesChart').getContext('2d');
    const data = {
        labels: ['Revenue Value', 'Loss Value'],
        datasets: [{
            data: [total_revenue, total_loss_value],
            backgroundColor: ['#2ecc71', '#e74c3c'],
            borderColor: ['#27ae60', '#c0392b'],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'doughnut',
        data: data,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  position: 'bottom',
              },
              title: {
                  display: true,
                  text: '($) Revenue / Loss'
              },
              tooltip: {
              callbacks: {
                label: function(context) {
                  let total = total_revenue + total_loss_value;
                  let value = context.raw.toLocaleString();
                  let percentage = ((context.raw / total) * 100).toFixed(1) + "%";
                  return `${context.label}: $${value} (${percentage})`;
                }
              }
            }
          }
        }
    };
    new Chart(ctx, config);
</script>



<script>
  var sales = <?= $totalSales ?>; //total quantity of livestock
  var losses = <?= $totalLosses ?>; //
  var currentStock = <?= $totalCurrent ?>;

  var ctxPie = document.getElementById("chart-pie").getContext("2d");

  new Chart(ctxPie, {
    type: "pie",
    data: {
      labels: ["Sales", "Losses", "Current Stock"],
      datasets: [{
        data: [sales, losses, currentStock],
        backgroundColor: [
          "#2ecc71", // Sales
          "#e74c3c", // Losses
          "rgba(45, 160, 237, 0.7)"  // Current stock
        ],
        borderColor: [
          "#27ae60",
          "#c0392b",
          "rgba(45, 160, 237, 1)"
        ],
        borderWidth: 1
      }]
    },
    options: {
      
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            font: {
              size: 12,
              family: "Open Sans"
            }
          }
        },
        
        title: {
            display: true,
            text: '(%) Sales / Losses'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              let total = sales + losses + currentStock;
              let value = context.raw;
              let percentage = ((value / total) * 100).toFixed(1) + "%";
              return `${context.label}: ${value} (${percentage})`;
            }
          }
        }
      },
      onClick: function(evt, elements) {
            if (elements.length > 0) {
                let datasetIndex = elements[0].datasetIndex;
                let dataIndex = elements[0].index;
                let label = this.data.labels[dataIndex];
                
                // Example: Redirect to a filtered table page
                //window.location.href = `/batches?filter=${encodeURIComponent(label)}`;
            }
        }
    }
  });
</script>


      

<?php $content = ob_get_clean(); require __DIR__ . '/../components/layouts/layout-auth.php'; ?>
