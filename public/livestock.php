<?php
ob_start(); 
$title = "Livestock Batches Overview"; 
?>
<?php

$batches = $batches ?? []; // Ensure it's defined
?>

<div class="row pt-4">
      <div class="col-md-12 pt-2">
        <div class="card mb-4">
          <div class="card-body">
          <div class="table-responsive p-0">
              <?php if (empty($batches)): ?>
                <div class="text-center py-4 ">
                  <p class="">No batches found for this livestock.</p>
                  <a href="#!" class="btn btn-md btn-outline-primary">ADD BATCH <span class="fa fa-plus"></span></a>
                </div>
              <?php endif; ?>
            
              <?php if (!empty($batches)): ?>
              <div class="card-header pb-0">
                <h6>All <span class="font-weight-bolder text-secondary text-uppercase"><?= $batches[0]['livestockName'] ?>  - <span class="text-sm">(<?= $batches[0]['category'] ?>)</span></span> Batches</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
            
              
              <table id="dataTable" class="table table-hover --table-striped align-items-center mb-0">
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
              <?php endif; ?>
          </div>
          </div>
        </div>
      </div>

    


</div>



<?php $content = ob_get_clean(); require __DIR__ . '/../components/layouts/layout-auth.php'; ?>
