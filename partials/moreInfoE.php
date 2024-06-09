<div class = "popup" id="popup">
	<div class="Users">
		<button type="button" class="moreInfoBtn" style = "margin-top:10px; ;"
		onclick="closePopup()">Close Table</button>
        <table id = "myTable" style="
            border: 1px solid #9f9e85 ;
            padding: 0px !important ;
            margin-top: 25px !important  ;
            font-size: 9px !important;
            font-family: monospace ;
            border-collapse: separate; 
            border-spacing: 2px; 
            text-align: center; ">
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
                <?php
                $connect = mysqli_connect("localhost", "root", "", "ims system") or die("Connection Failed");
                $query = "SELECT * FROM equipment";
                $result = mysqli_query($connect, $query); 
                $index = 0; // Initialize index variable

                while ($row = mysqli_fetch_assoc($result)) {
                    $index++; // Increment index for each row
                ?>
                <tr>
                    <td><?= $index ?></td>
                    <td class="serial_num"><?php echo $row['serial_num'] ?></td>
                    <td class="img">
                        <img class="equip_img" src="uploads/equipments/<?php echo $row['img']?>" >
                    </td>
                    <td class="equip_name"><?php echo $row['equip_name'] ?></td>
                    <td class="quantity"><?php echo $row['quantity'] ?></td>
                    <td class="brand_model"><?php echo $row['brand_model'] ?></td>
                    <td>
                        <?php 
                        $equipId = $row['created_by'];
                        $stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
                        $stmt->bind_param("i", $equipId);
                        if ($stmt->execute()) {
                            $result_user = $stmt->get_result();
                            if ($result_user->num_rows > 0) {
                                $user_row = $result_user->fetch_assoc();
                                echo $user_row['name'];
                            } else {
                                echo "User not found"; 
                            }
                        }
                        ?>
                    </td>
                    <td class= "location" style="font-weight: bold;"><?php echo $row['location'] ?></td>
                    <td class="remarks">
                        
                        <?php if ($row['remarks'] == 'No Remarks'): ?>
                        <span class="status-green"><?= $row['remarks'] ?></span>
                        <?php elseif ($row['remarks'] == 'For Repair'): ?>
                        <span class="status-orange"><?= $row['remarks'] ?></span>
                        <?php else: ?>
                            <?= $row['remarks'] ?>
                        <?php endif; ?>
                    </td>
                    <td class="status">
                        
                        <?php if ($row['status'] == 'Serviceable'): ?>
                        <span class="status-green"><?= $row['status'] ?></span>
                        <?php elseif ($row['status'] == 'Not Serviceable'): ?>
                        <span class="status-orange"><?= $row['status'] ?></span>
                        <?php else: ?>
                            <?= $row['status'] ?>
                        <?php endif; ?>
                    </td>
                    
                    <td><?php echo $row['maintenance'] ?></td>
                    <td><?php echo $row['created_at'] ?></td>
                    <td><?php echo $row['updated_at'] ?></td>
                </tr> 
                <?php
                } 
                ?>
            </tbody>

        </table>
        <p class="equip_count"><?= $index ?> items </p>

    </div>
    	
</div>
