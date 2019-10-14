<div class="container" >
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" style="color:skyblue;">Quote Id</th>
            <th scope="col" style="color:skyblue;" >Quote Cover</th>
            <th scope="col" style="color:skyblue;">Quote Name</th>
            <th scope="col" style="color:skyblue;">Category Id</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($quotes_by_category)): ?>
            <?php foreach($quotes_by_category as $quote): ?>
        <tr class="ali">
            <td><?php echo $cat['quote_name']; ?></td>
            <td><?php echo $quote['quote_cover']; ?></td>
            <td><?php echo $quote['quote_name']; ?></td>
            <td><?php echo $quote['category_id']; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else:?>
        <tr>
            <td>No Quotes Found!</td>
        </tr>
        <?php endif; ?>
    </tbody>
    </table> 
</div>