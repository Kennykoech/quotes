<?php if($this->session->flashdata('admin_loggedin')): ?>
  <?php echo '<p class="alert alert-success">' .$this->session->flashdata('admin_loggedin').'</p>';?>
<?php endif; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3><i class="fa fa-dashboard"></i>
        Dashboard
        <small>Control panel</small>
      </h3>
    
    </section>

    <!-- Main content -->
    <div class="search_form">
				<?php echo form_open('quotes/search_quote')?>
					<?php echo form_input(array('name'=>'search'))?>
					<?php echo form_submit('search_submit','Search')?>
      			<?php echo form_close()?>
			</div>

    
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">General Quotes</a></li>
          <li class="breadcrumb-item">Filter Quotes By Category
            <div class="form-group">
                <option value="">
                  
                </option>
            </div>
        </li>
        </ol>
      </nav>
    <!-- /.content -->

<h3>Searched quote</h3>
<div class="container">
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Quote Id</th>
        <th scope="col">Quote Cover</th>
        <th scope="col">Quote Name</th>
        <th scope="col">Category Id</th>
        <th scope="col">Remove Quote</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($quotes)): ?>
            <?php foreach($quotes as $quote): ?>
        <tr class="">
            <td><?php echo $quote->quote_id?></td>
            <td><img src="<?php echo site_url(); ?>/assets/images/quotes/<?php echo $quote->quote_cover?>" height="200" width="200" ></td>
            <td><?php echo $quote->quote_name?></td>
            <td><?php echo $quote->category_id ?></td>
            <td><a href="<?php echo base_url();?>quotes/delete_quote/<?php echo $quote->quote_id?>" class="btn btn-danger">Delete</a></td>
        </tr> 
        <?php endforeach; ?>
        <?php else:?>
        <tr>
            <td><h3>There is no such quote!</h3><td>
        </tr>
      <?php endif; ?>
    </tbody>
  
    </table> 
</div>
  </div>