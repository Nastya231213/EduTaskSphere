<?php $this->view('includes/navigation',['title'=>'Message']);?>
<?php if(isset($message)):?>
<div class="container mt-4">
<center><h2><?=$message?></h2></center>
</div>
<?php endif;?>