<div class="login-box-body">
    <div class="col-md-6 col-md-offset-3">
            <h3>Add Quote</h3>
        
            <form action="<?php echo base_url();?>quotes/save_quote" method="post" enctype="multipart/form-data">
                <?php if($msg = $this->session->flashdata('msg')):?>
                    <h3><?php echo $msg;?></h3>
                <?php endif;?>
                <div class="form-group">
                    <input type="file" name="userfile" size="20">
                </div>

                <div class="form-group">
                    <input type="text" name="quote_name" size="20" placeholder="Enter quote name">
                </div>
                
                <div class="form-group">
                    <label>Choose quote category name below</label>
                    <select name="category_id" class="form-control">
                    <?php foreach($category as $cat): ?>
                        <option value="<?php echo $cat['category_id']; ?>" ><?php echo $cat['category_name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" align-text="center">Add Quote</button>   
            </form>
    </div>
</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>