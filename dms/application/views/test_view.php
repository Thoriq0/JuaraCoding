<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div>
<?php
                                $i=0;
                                $j=1;
                                
                                    foreach($dataUser as $dp) {?>
                                        <?php echo ($j%3==1)?'<div class="row">':'';?>   
                                        <div class="col-sm-4">
                                        <h1>
                                            <?php echo $dp['email'] ?>
                                        </h1>
                                        </div>
                            <?php   }
                                
                            ?>
</div>