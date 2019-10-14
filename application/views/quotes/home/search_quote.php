<h3>Searched quote</h3>
<div class="container">
    <table class="table table-hover">
    <thead>
        <tr>

            <th scope="col">Quote Cover</th>
            <th scope="col">Quote Name</th>
    
        </tr>
    </thead>
    <tbody>
        <?php if(count($quotes)): ?>
            <?php foreach($quotes as $quote): ?>
        <tr class="">
            <td><img src="<?php echo site_url(); ?>/assets/images/quotes/<?php echo $quote->quote_cover;?>" height="200" width="200" ></td>
            <td><?php echo $quote->quote_name;?></td>      
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