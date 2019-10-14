<div class="container" align-text="center">
    <form action="<?php echo site_url();?>categories/edit_category/<?php echo $category->category_id; ?>" method="post">
        <div class="form-group">
                <input type="text" name="category_name" class="form-control" value="<?php echo $category->category_name; ?>">
        </div><br>
        <button type="submit" class="btn btn-primary" align-text="center">Update Category</button>
    </form>
</div>