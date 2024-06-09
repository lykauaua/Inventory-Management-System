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
        text-align: center; ">

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
                <?php foreach ($tools as $index => $tool) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td class="serial_num"><?= $tool['serial_num'] ?></td>
                        <td class="img">
                            <img class="equip_img" src="uploads/tools/<?= $tool['img'] ?>" >
                        </td>
                        <td class="equip_name"><?= $tool['equip_name'] ?></td>
                        <td class="quantity"><?= $tool['quantity'] ?></td>
                        <td class="brand_model"><?= $tool['brand_model'] ?></td>
                        <td>
                            <?php 
                                $equipId = $tool['created_by'];
                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                                $stmt->execute([$equipId]);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $created_by_name = $row ? $row['name'] : "User not found";
                                echo $created_by_name;
                            ?>
                        </td>
                        <td class= "location" style="font-weight: bold;"><?= $tool['location'] ?></td>
                        <td class="remarks">
                        <?php if ($tool['remarks'] == 'No Remarks'): ?>
                            <span class="status-green"><?= $tool['remarks'] ?></span>
                        <?php elseif ($tool['remarks'] == 'For Repair'): ?>
                            <span class="status-orange"><?= $tool['remarks'] ?></span>
                        <?php else: ?>
                            <?= $tool['remarks'] ?>
                        <?php endif; ?> </td>

                        <td class="status">
                        <?php if ($tool['status'] == 'Good Condition'): ?>
                            <span class="status-green"><?= $tool['status'] ?></span>
                        <?php elseif ($tool['status'] == 'Needs Relief'): ?>
                            <span class="status-orange"><?= $tool['status'] ?></span>
                        <?php else: ?>
                            <?= $tool['status'] ?>
                        <?php endif; ?>
                    </td>
                        <td><?= $tool['maintenance'] ?></td>
                        <td><?= $tool['created_at'] ?></td>
                        <td><?= $tool['updated_at'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    <p class = "equip_count"><?= count($tools) ?> items </p>
</div><!-- 
    	<p style="font-family: monospace;"> Tools Table </p> -->
</div>
