<div class="lsb_i" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
   <div class="lsb_ic">
      <? if ($sql['type_name']): ?> <div class="lsb_ih"><?=$sql['type_name']?>:</div> <? endif ?>
      <div class="prd_txt <?=($sql['type'] == 'txt_warning'?'prd_txt_warning':'')?>">
         <? if ($sql['type'] == 'txt_warning'): ?> <i class="fal fa-exclamation-circle"></i> <? endif ?>
         <?=$sql['txt']?>
      </div>
   </div>
</div>