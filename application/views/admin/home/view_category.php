<div class="container" >
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" style="color:skyblue;">Quote Category</th>
            <th scope="col" style="color:skyblue;" >View Quotes</th>
            <th scope="col" style="color:skyblue;">Edit Quote</th>
            <th scope="col" style="color:skyblue;">Delete Quote</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($category)): ?>
            <?php foreach($category as $cat): ?>
        <tr class="ali">
            <td style="color:lightseagreen;"><?php echo $cat['category_name']; ?></td>
            <td style=""><a class="btn btn-success"href="<?php echo base_url();?>categories/view_quotes_by_category/<?php echo $cat['category_id']; ?>">view</a></td>
            <td style=""><a class="btn btn-primary"href="<?php echo base_url();?>categories/update_category/<?php echo $cat['category_id']; ?>">edit</a></td>
            <td style=""><a class="btn btn-danger" href="<?php echo base_url();?>categories/delete_category/<?php echo $cat['category_id']; ?>">delete</a></td>
        </tr>
        <?php endforeach; ?>
        <?php else:?>
        <tr>
            <td>No Quotes Found!</td>
        </tr>
        <?php endif; ?>
    </tbody>
    </table> 
    <?php echo $this->pagination->create_links();?>
</div>