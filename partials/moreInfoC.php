<div class = "popup" id="popup">
	<div class="Users">
        <button type="button" class="moreInfoBtn" style = "margin-top:10px; ;"
        onclick="closePopup()">Close Table</button>
        <table id = "myTable" style="
        border: 1px solid #9f9e85 ;
        padding: 3px ;
        margin-top: 25px ;
        font-family: monospace ;
        border-collapse: separate; 
        border-spacing: 2px; 
        text-align: center;
        font-size: 17px; ">

            <thead style="text-align: center;">
                <tr>
               <th>#</th>
                <th>Serial No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Brand Model</th>
                <th>Created By</th>
                <th>Location</th>
                <th>Remarks</th>
                <th>Status</th>
                <th>Maintenance</th>
                <th>Created At</th>
                <th>Updated At</th>
                </tr>

            </thead>
            <tbody> 

                <?php foreach ($consumables as $index =>$consumable) { ?>
                 <tr>
                    <td><?= $index + 1 ?></td>
                    <td class="serial_num"><?= $consumable['serial_num'] ?></td>
                    <td class="img">
                        <img class="equip_img" src="uploads/consumables/<?= $consumable['img']?>" >
                    </td>
                    <td class="equip_name"><?= $consumable['equip_name'] ?></td>
                    <td class="quantity"><?= $consumable['quantity'] ?></td>
                    <td class="brand_model"><?= $consumable['brand_model'] ?></td>
                     <td>
                         <?php 
                                $equipId = $consumable['created_by'];
                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                                $stmt->execute([$equipId]);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $created_by_name = $row ? $row['name'] : "User not found";
                                echo $created_by_name;
                            ?>
                     </td>
                    <td class= "location" style="font-weight: bold;"><?= $consumable['location'] ?></td>
                    <td class="remarks">
                    <?php if ($consumable['remarks'] == 'No Remarks'): ?>
                        <span class="status-green"><?= $consumable['remarks'] ?></span>
                    <?php elseif ($consumable['remarks'] == 'For Repair'): ?>
                        <span class="status-orange"><?= $consumable['remarks'] ?></span>
                    <?php else: ?>
                        <?= $consumable['remarks'] ?>
                    <?php endif; ?> </td>

                    <td class="status">
                    <?php if ($consumable['status'] == 'High Stocks'): ?>
                        <span class="status-green"><?= $consumable['status'] ?></span>
                    <?php elseif ($consumable['status'] == 'Low Stocks'): ?>
                        <span class="status-orange"><?= $consumable['status'] ?></span>
                    <?php else: ?>
                        <?= $consumable['status'] ?>
                    <?php endif; ?>
                </td>
                <td><?= $consumable['maintenance'] ?></td>
                <td><?= $consumable['created_at'] ?></td>
                <td><?= $consumable['updated_at'] ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
        <p class = "equip_count"><?= count($consumables) ?> items </p>
</div>
    	
</div>

