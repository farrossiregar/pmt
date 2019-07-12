<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="headings">
                <th class="column-title">No</th>
                <th class="column-title">PR Number </th>
                <th class="column-title">PR Date</th>
                <th class="column-title">RFQ Number </th>
                <th class="column-title">RFQ Date </th>
                <th class="column-title">PO Number </th>
                <th class="column-title">Supplier </th>
                <th class="column-title">Material </th>
                <th class="column-title">QTY </th>
                <th class="column-title">UOM </th>
                <th class="column-title">Total Price </th>
                <th class="column-title">PPN / NON PPN </th>
                <th class="column-title">Top </th>
                <th class="column-title">Code Project </th>
                <th class="column-title">Project Name </th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($data as $key => $item): ?>
                <tr class="even pointer">
                    <td class="a-center "><?=($key+1)?></td>
                    <td><?=($item->purchase_request_no)?></td>
                    <td><?=($item->pr_date)?></td>
                    <td><?=($item->rfq_no)?></td>
                    <td><?=($item->rfq_date)?></td>
                    <td><?=($item->po_no)?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> 
            <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

