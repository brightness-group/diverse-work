@if(null !== ($messages))
<?php foreach($messages as $msg){?>
<div class="<?php if($msg->type=='reply'){?>chate-box-left<?php }else{?>chate-box-right<?php }?>">
    <div class="list-group-item <?php if($msg->type=='reply'){?>friend-message<?php }else{?>my-message<?php }?>">
        <span><?php if($msg->type=='reply'){?>{{$company->name}}<?php }else{?>{{$seeker->name}}<?php }?></span>{{$msg->message}}
        <?php if($msg->type=='reply'){?> 
        	{{$company->printCompanyImage()}} 
        <?php }else{?>
        	{{$seeker->printUserImage(100, 100)}}
        <?php }?>
    </div>
    <div class="date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $msg->updated_at)->format('l g:i a') }}</div>
</div>
<?php } ?>
@endif