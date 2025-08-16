

<!-- ADD BATCH MODAL -->
<div class="modal fade add_batch_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg p-2">
    <div class="modal-content p-2">
      <div class="p-3">
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">ADD NEW BATCH</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_batch">
            <!-- Row 1: Livestock ID + Batch Name -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="livestockID" class="form-label">Livestock</label>
                    <select name="livestockID" id="livestockID" class="form-select">
                        <!-- Loop from DB: Example -->
                        <option value="">Select livestock</option>
                            <?php foreach ($livestock as $livestockitem) : ?>
                                <option value="<?= $livestockitem['id'] ?>"><?= htmlspecialchars($livestockitem['livestockName']) ?> - <?= htmlspecialchars($livestockitem['category']) ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="batchName" class="form-label">Batch Name</label>
                    <input name="batchName" type="text" id="batchName" class="form-control" placeholder="Enter batch name">
                </div>
            </div>

            <!-- Row 2: Quantity + Cost Per Unit -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input name="batchQuantity" type="number" id="quantity" class="form-control" placeholder="Enter quantity">
                </div>
                <div class="col-md-6">
                    <label for="costPerUnit" class="form-label">Cost Per Unit</label>
                    <input name="costPerUnit" type="number" step="0.01" id="costPerUnit" class="form-control" placeholder="Enter cost per unit">
                </div>
            </div>

            <!-- Row 3: Purchase Date + Expected At -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="purchaseDate" class="form-label">Purchase Date</label>
                    <input name="purchaseDate" type="date" id="purchaseDate" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="expected_at" class="form-label">Expected At</label>
                    <input name="expected_at" type="date" id="expected_at" class="form-control">
                </div>
            </div>

            <!-- Row 4: Purchased From + Status -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="purchasedFrom" class="form-label">Purchased From</label>
                    <input name="purchasedFrom" type="text" id="purchasedFrom" class="form-control" placeholder="Enter supplier name">
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any additional details"></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    </div>
  </div>
</div>




<!-- ADD LIVESTOCK MODAL -->
<div class="modal fade add_new_livestock_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="p-3">
      
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">ADD NEW LIVESTOCK</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_livestock">
          <div class="row mb-3">
              <div class="col-md-6">
                  <label for="livestockName" class="form-label">Livestock Name</label>
                  <input name="livestockName" type="text" id="livestockName" class="form-control" placeholder="Enter livestock name">
              </div>
              <div class="col-md-6">
                  <label for="category" class="form-label">Livestock category</label>
                  <input name="category" type="text" id="category" class="form-control" placeholder="Enter batch category">
              </div>
          </div>
          
              <!-- Buttons -->
              <div class="text-end">
                  <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- ADD SALES MODAL -->
<div class="modal fade add_sales_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md p-2">
    <div class="modal-content p-2">
      <div class="p-3">
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">ADD SALE</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_sale">

            <input type="hidden" name="batchID" value="<?= $_GET['batch'] ?? 0 ?>">
            <!-- Row 2: Quantity + Cost Per Unit -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input name="quantity" type="number" id="quantity" class="form-control" placeholder="Enter quantity">
                </div>
                
                <div class="col-md-6">
                    <label for="unitPrice" class="form-label">Cost Per Unit</label>
                    <input name="unitPrice" type="number" step="0.01" id="unitPrice" class="form-control" placeholder="Enter cost per unit">
                </div>
            </div>

            <!-- Row 3: Purchase Date + Expected At -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="buyerName" class="form-label">Buyer Name</label>
                    <input name="buyerName" type="text" id="buyerName" class="form-control" placeholder="Enter buyer name">
                </div>

                <div class="col-md-6">
                    <label for="soldOn" class="form-label">Sold On</label>
                    <input name="soldOn" type="date" id="soldOn" class="form-control">
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any additional details"></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    </div>
  </div>
</div>




<!-- ADD LOSS MODAL -->
<div class="modal fade add_loss_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md p-2">
    <div class="modal-content p-2">
      <div class="p-3">
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">ADD LOSS</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_loss">

            <input type="hidden" name="batchID" value="<?= $_GET['batch'] ?? 0 ?>">
            <!-- Row 2: Quantity + Cost Per Unit -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input name="quantity" type="number" id="quantity" class="form-control" placeholder="Enter quantity">
                </div>
                
                <div class="col-md-6">
                    <label for="unitPrice" class="form-label">Cost Per Unit</label>
                    <input name="unitPrice" type="number" step="0.01" id="unitPrice" class="form-control" placeholder="Enter cost per unit">
                </div>
            </div>

            <!-- Row 3: Purchase Date + Expected At -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="reason" class="form-label">Reason</label>
                    <input name="reason" type="text" id="reason" class="form-control" placeholder="Enter reason">
                </div>

                <div class="col-md-6">
                    <label for="dateIncurred" class="form-label">Date Incurred</label>
                    <input name="dateIncurred" type="date" id="dateIncurred" class="form-control">
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any additional details"></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    </div>
  </div>
</div>



<!-- ADD MEDICAL RECORD MODAL -->
<div class="modal fade add_health_record_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md p-2">
    <div class="modal-content p-2">
      <div class="p-3">
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">ADD HEALTH RECORD</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_health_record">

            <input type="hidden" name="batchID" value="<?= $_GET['batch'] ?? 0 ?>">
            <!-- Row 2: Quantity + Cost Per Unit -->

            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dateRecorded" class="form-label">Date Recorded</label>
                    <input name="dateRecorded" type="date" id="dateRecorded" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="type" class="form-label">Type</label>
                    <input name="type" type="text" id="type" class="form-control" placeholder="Enter type of health activity">
                </div>
                
                <div class="col-md-6">
                    <label for="estimated_costs" class="form-label">Estimated Costs</label>
                    <input name="estimated_costs" type="number" step="0.01" id="estimated_costs" class="form-control" placeholder="Enter estimated costs">
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any additional details"></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    </div>
  </div>
</div>



<!-- ADD GROWTH LOG MODAL -->
<div class="modal fade add_growth_log_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md p-2">
    <div class="modal-content p-2">
      <div class="p-3">
        <div><span class="close" data-dismiss="modal" aria-label="Close">x</span></div>
        <!-- Header -->
        <div class="border-bottom mb-3 pb-2">
            <h5 class="mb-0">RECORD GROWTH</h5>
        </div>

        <!-- Form start -->
        <form method="POST" action="/add_growth_log">

            <input type="hidden" name="batchID" value="<?= $_GET['batch'] ?? 0 ?>">
            <!-- Row 2: Quantity + Cost Per Unit -->

            

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dateRecorded" class="form-label">Date Recorded</label>
                    <input name="dateRecorded" type="date" id="dateRecorded" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label for="averageWeight" class="form-label">Average Weight</label>
                    <input name="averageWeight" type="number" step="0.01" id="averageWeight" class="form-control" placeholder="Enter average weight">
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any additional details"></textarea>
            </div>

            <!-- Buttons -->
            <div class="text-end">
                <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    </div>
  </div>
</div>