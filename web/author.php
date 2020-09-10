<?php require_once "web/header.php"; ?>
<div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>#</strong></th>
                    <th><strong>Author Name</strong></th>
                </tr>
            </thead>
            <tbody id="author_list">
                    <?php
                    if (! empty($authorList)) {
                        $cnt = 1;
                        foreach ($authorList as $k => $v) {
                            ?>
          					<tr>
			                    <td><?php echo $cnt++; ?></td>
			                    <td><?php echo $result[$k]["a_name"]; ?></td>
			                </tr>
                    <?php
                        }
                    }
                    ?>
                
            
            
            <tbody>
        
        </table>
    </div>