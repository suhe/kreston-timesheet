        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
		   <b>
           <a  href="<?php echo base_url();?>client/admin/add">Total Client : <?php echo $this->db->count_all('josh_company'); ?> Perusahaan</a>
           </b>
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Code</th>	
              <th>Name</th>
              <th>Address</th>
              <th>Location</th>
			  <th>Transport AK</th>
			  <th>Transport EF</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['address'];?></td>
               <td><?php echo $rec['city'].','.$rec['country'];?></td>
			   <td><?php echo number_format($rec['transport'],2);?></td>
               <td><?php echo number_format($rec['transport2'],2);?></td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>