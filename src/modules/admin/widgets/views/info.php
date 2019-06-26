<?php
/**
 * @var $action string
 */

$js =<<<JS

$('.btn-info-review').on('click',function(e) {
  e.preventDefault();
  var model_id = $(this).data('id');
  console.log(model_id);
  $.ajax({
   url:'{$action}',
   type:'POST',
   data:{id:model_id},
   success:function(data) {
       console.log(data);
       $('#reviewInfoModalLongTitle').html('').html(data.title);
       $('#reviewInfoModalCenter').find('div.modal-body').html('').html(data.body);
       $('#bnt-review-modal').trigger('click');
   }
    
  });
  
})



JS;

$this->registerJs($js);
?>
<button type="button" class="btn btn-primary" style="display: none;" id="bnt-review-modal" data-toggle="modal" data-target="#reviewInfoModalCenter"></button>

<div class="modal fade" id="reviewInfoModalCenter" tabindex="-1" role="dialog" aria-labelledby="reviewInfoModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewInfoModalLongTitle">sd</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>