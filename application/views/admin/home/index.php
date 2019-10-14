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

    <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo site_url();?>admin">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" 
        value="<?php if($this->input->get('keyword')) echo $this->input->get('keyword');?>">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <br><br><br> 

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
          <li class="breadcrumb-item">Select Quotes by Category
            <?php foreach($category as $cat): ?>
            <form action="<?php echo base_url();?>quotes/get_quotes_by_category" method="post">
            <?php endforeach; ?>
                <select name="category_id" class="form-control">
                    <?php foreach($category as $cat): ?>
                        <option name = "category_id" value="<?php echo $cat['category_id']; ?>" ><?php echo $cat['category_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                  <button type="submit" class="btn btn-primary" align-text="center">Get Quotes by Category</button> 
            </form>
        </li>
        </ol>
      </nav>   
    <!-- /.content -->
    <?php 
      if($this->input->get('keyword'))
      {
        ?>
          <b>Search result for "<?php echo $this->input->post('keyword'); ?>"</b>
        <?php
      }
    ?>
<div class="container">
    <table class="table table-hover">
    <thead>
        <tr>
          <th scope="col">Quote Cover</th>
          <th scope="col">Quote Name</th>
          <th scope="col">Category Id</th>
          <th scope="col">Remove Quote</th>
        </tr>
    </thead>
    <tbody>
            <h3>General Quotes</h3>
        <?php if(count($quotes)): ?>
            <?php foreach($quotes as $quote): ?>
        <tr class="">
            <td><img src="<?php echo site_url(); ?>/assets/images/quotes/<?php echo $quote->quote_cover;?>" height="200" width="200" ></td>
            <td><?php echo $quote->quote_name;?></td>
            <td><?php echo $quote->category_id;?></td>
            <td><a href="<?php echo base_url();?>quotes/delete_quote/<?php echo $quote->quote_id;?>" class="btn btn-danger">Delete</a></td>
        </tr> 
        <?php endforeach; ?>
        <?php else:?>
        <tr>
            <td><h3>There are no quotes!</h3><td>
        </tr>
      <?php endif; ?>
    </tbody>
    </table> 
    
    <?php echo $this->pagination->create_links();?>
</div>
  </div>