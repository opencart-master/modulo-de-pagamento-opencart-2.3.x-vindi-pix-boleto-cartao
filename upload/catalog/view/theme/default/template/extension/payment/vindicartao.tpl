<div id="apireturn"></div>
<form class="form-horizontal" id="form-pay" data-yapay="payment-form">
  <fieldset id="payment">
    <legend><center><?php echo $text_credit_card; ?></center></legend>
	  
   <div class="col-sm-6">
        
	<div class="form-group required">
	<div class="col-sm-12">	
      <label class="col-sm-4 control-label" for="input-cc-type"><?php echo $entry_cc_type; ?></label>
      <div class="col-sm-6">
        <select name="cc_bandeira" id="input-cc-type" class="form-control">
          <?php  foreach ($cards as $card) { ?>
          <option value="<?php echo $card['value']; ?>"><?php echo $card['text']; ?></option>
          <?php } ?>
        </select>
      </div>
	</div>
    </div> 
	
	<div class="form-group required">
	<div class="col-sm-12">		 
	 <label class="col-sm-4 control-label" for="cc_number"><?php echo $entry_cc_number; ?></label>
      <div class="col-sm-6">
        <input type="text" name="cc_number" maxlength="16" value="" placeholder="<?php echo $entry_cc_number; ?>" id="cc_number" class="form-control" />
      </div>
	  </div>
    </div> 
    
    <div class="form-group required">
    <div class="col-sm-12">		 
	 <label class="col-sm-4 control-label" for="cc_data"><?php echo $entry_cc_mes; ?></label>
      <div class="col-sm-6">
       <select name="cc_data" id="cc_data" class="form-control">
          <?php  foreach ($months as $month) { ?>
          <option value="<?php echo $month['value']; ?>"><?php echo $month['text']; ?></option>
          <?php } ?>
      </select>
      </div>
	  </div>
    </div>
    
    <div class="form-group required">
    <div class="col-sm-12">		 
	 <label class="col-sm-4 control-label" for="cc_data1"><?php echo $entry_cc_ano; ?></label>
      <div class="col-sm-6">
        <select name="cc_data1" id="cc_data1" class="form-control">
          <?php  foreach ($year_valids as $year_valid) { ?>
          <option value="<?php echo $year_valid['value']; ?>"><?php echo $year_valid['text']; ?></option>
          <?php } ?>
      </select> 
      </div>
	  </div>
    </div>
    
    </div>
    <div class="col-sm-6">	
    
    <div class="form-group required">
	<div class="col-sm-12">		 
	 <label class="col-sm-5 control-label" for="input-cc-cvv"><?php echo $entry_cc_cvv; ?></label>
      <div class="col-sm-6">
      <input type="text" name="cc_cvv" maxlength="4" value="" placeholder="<?php echo $entry_cc_cvv; ?>" id="cc_cvv" class="form-control" />  
      </div>
	  </div>
    </div>
    
    <div class="form-group required">
	<div class="col-sm-12">		 
	 <label class="col-sm-5 control-label" for="cc_name"><?php echo $entry_cc_name; ?></label>
      <div class="col-sm-6">
      <input type="text" name="cc_name" value="" placeholder="<?php echo $entry_cc_name; ?>" id="cc_name" class="form-control" />  
      </div>
	  </div>
    </div>
    
    <div class="form-group required">
	  <div class="col-sm-12">		 
	  <label class="col-sm-5 control-label" for="cc_doc"><?php echo $entry_cc_doc; ?></label>
      <div class="col-sm-6">
      <input type="text" name="cc_doc" maxlength="11" value="<?php echo $doc; ?>" placeholder="<?php echo $entry_cc_doc; ?>" id="cc_doc" class="form-control" />  
      </div>
	  </div>
    </div>
    
     <div class="form-group required">
	  <div class="col-sm-12">		 
	  <label class="col-sm-5 control-label" for="cc_parc"><?php echo $entry_cc_parc; ?></label>
      <div class="col-sm-6">
      <select name="cc_parc" id="input-cc-parc" class="form-control">
	  </select>  
      </div>
	  </div>
    </div>
    
    </div>
  </fieldset>
</form>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary button" data-loading-text="<?php echo $text_loading; ?>" />
  </div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').on('click', function() {
	$.ajax({
		url: 'index.php?route=extension/payment/yapayc/confirm',
		type: 'post',
		data: $("#form-pay").serialize(),
		dataType: 'json',
		beforeSend: function() {
			$('#button-confirm').button('loading');
		},
		complete: function() {
			$('#button-confirm').button('reset');
		},
		success: function(json) {
		    $('.alert-danger').remove();
			$('#button-confirm').button('reset');
			$('.text-danger').remove();
			
			for (z in json['val']) {
			var nos = z;
			$('#payment input[name=\''+ nos +'\']').parent().removeClass('has-error');
			$('#payment select[name=\''+ nos +'\']').parent().removeClass('has-error');
			}
			
		    if (json['error']) {
			for (i in json['error']) {
			var eu = i;
			for (v in json['val']) {
			var vc = v;
			    if(eu === vc){
		        $('#payment input[name=\''+json['val'][v]+'\']').after('<div class="text-danger">' + json['error'][i] + '</div>');
		        $('#payment select[name=\''+json['val'][v]+'\']').after('<div class="text-danger">' + json['error'][i] + '</div>');
				$('.text-danger').parent().addClass('has-error');
				}
	    	}
	    	}
			}
			
		    if (json['warning']) {
				$('#apireturn').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['warning'] + '</div>');
				$('#cc_cvv').val("");
			}
			
			if (json['success']) {
				location = '<?php echo $continue; ?>';
			}
		
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('select[name=\'cc_bandeira\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=extension/payment/yapayc/parcela&bandeira_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'cc_bandeira\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			$('#button-confirm').button('loading');
		},
		complete: function() {
			$('.fa-spin').remove();
			$('#button-confirm').button('reset');
		},
		success: function(json) {

			html = '<option value="" selected="selected">Escolha uma Parcela</option>';

			if (json['parc'] && json['parc'] != '') {
				for (i = 0; i < json['parc'].length; i++) {
					html += '<option value="' + json['parc'][i]['value'] + '"';
					html += '>' + json['parc'][i]['text'] + '</option>';
				}
			} 

			$('select[name=\'cc_parc\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'cc_bandeira\']').trigger('change');
//--></script>
<script type="text/javascript"><!--
$(document).ready(function(){
<?php if($sec == 'f') { ?>
window.yapay.FingerPrint({ env: 'sandbox' });
<?php } else { ?>
window.yapay.FingerPrint();
<?php } ?>
 });

$.getScript('https://static.traycheckout.com.br/js/finger_print.js');
$(document).FingerPrint().getFingerPrint();

//--></script>