<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-vindipix" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if($atual) { ?>
	<div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> Existe uma nova versão do módulo <b><?php echo $module_name; ?></b> faça o download <a href="<?php echo $murl; ?>" target="_blank">AQUI</a> <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
	<?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-vindipix" class="form-horizontal">
	 <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-help" data-toggle="tab"><?php echo $tab_help; ?></a></li>
          </ul>
	 <div class="tab-content">

    <div class="tab-pane active" id="tab-general">
		<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
            <div class="col-sm-10">
             <input type="text" name="payment_vindipix_title" value="<?php echo $payment_vindipix_title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
			  <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
            </div>
          </div>
         <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-token"><?php echo $entry_token; ?></label>
            <div class="col-sm-10">
              <input type="text" name="payment_vindipix_token" value="<?php echo $payment_vindipix_token; ?>" placeholder="<?php echo $entry_token; ?>" id="input-token" class="form-control" />
			  <?php if ($error_token) { ?>
              <div class="text-danger"><?php echo $error_token; ?></div>
              <?php } ?>
            </div>
          </div>
         <div class="form-group" style="display:none;">
            <label class="col-sm-2 control-label" for="input-days"><?php echo $entry_days; ?></label>
            <div class="col-sm-10">
              <input type="text" name="payment_vindipix_days" value="<?php echo $payment_vindipix_days; ?>" placeholder="<?php echo $entry_days; ?>" id="input-days" class="form-control" />
            </div>
          </div>
		 <div class="form-group required">
		 <label class="col-sm-2 control-label"><?php echo $entry_doc; ?></label>
			 <div class="col-sm-10">
			        <select name="payment_vindipix_doc" id="input-doc" class="form-control">
				    <option value=""><?php echo $text_none; ?></option>
				    <?php foreach($custom_fields as $custom_field) { ?>
				     <?php if ($custom_field['location'] == 'account') { ?>
					<?php if ($payment_vindipix_doc == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?><?php } ?>
			        </select>
			  <?php if ($error_doc) { ?>
              <div class="text-danger"><?php echo $error_doc; ?></div>
              <?php } ?>	 
			</div>
		  </div>
         <div class="form-group">
		 <label class="col-sm-2 control-label"><?php echo $entry_doc2; ?></label>
			 <div class="col-sm-10">
			        <select name="payment_vindipix_doc2" id="input-doc" class="form-control">
				    <option value=""><?php echo $text_none; ?></option>
				    <?php foreach($custom_fields as $custom_field) { ?>
				     <?php if ($custom_field['location'] == 'account') { ?>
					<?php if ($payment_vindipix_doc2 == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?><?php } ?>
			        </select>	 
			</div>
		  </div>
		 <div class="form-group">
		 <label class="col-sm-2 control-label"><?php echo $entry_raz; ?></label>
			 <div class="col-sm-10">
			        <select name="payment_vindipix_raz" id="input-doc" class="form-control">
				    <option value=""><?php echo $text_none; ?></option>
				    <?php foreach($custom_fields as $custom_field) { ?>
				     <?php if ($custom_field['location'] == 'account') { ?>
					<?php if ($payment_vindipix_raz == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?><?php } ?>
			        </select>	 
			</div>
		  </div>
		 <div class="form-group required">
		 <label class="col-sm-2 control-label"><?php echo $entry_number; ?></label>
			 <div class="col-sm-10">
			        <select name="payment_vindipix_number" id="input-number" class="form-control">
				    <option value=""><?php echo $text_none; ?></option>
				    <?php foreach($custom_fields as $custom_field) { ?>
				     <?php if ($custom_field['location'] == 'address') { ?>
					<?php if ($payment_vindipix_number == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?><?php } ?>
			        </select>
			  <?php if ($error_number) { ?>
              <div class="text-danger"><?php echo $error_number; ?></div>
              <?php } ?>	 
			</div>
		  </div>
		 <div class="form-group">
		 <label class="col-sm-2 control-label"><?php echo $entry_complement; ?></label>
			 <div class="col-sm-10">
			        <select name="payment_vindipix_complement" id="input-complement" class="form-control">
				    <option value=""><?php echo $text_none; ?></option>
				    <?php foreach($custom_fields as $custom_field) { ?>
				     <?php if ($custom_field['location'] == 'address') { ?>
					<?php if ($payment_vindipix_complement == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?><?php } ?>
			        </select>
			</div>
		  </div>
		 <div class="form-group">
            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payment_vindipix_total" value="<?php echo $payment_vindipix_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status_pen; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payment_vindipix_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status_can; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_order_status_id1" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payment_vindipix_order_status_id1) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status_apr; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_order_status_id2" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payment_vindipix_order_status_id2) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
	      <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status_con; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_order_status_id3" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payment_vindipix_order_status_id3) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $payment_vindipix_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="payment_vindipix_sort_order" value="<?php echo $payment_vindipix_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="payment_vindipix_status" id="input-status" class="form-control">
                <?php if ($payment_vindipix_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
				<br>
			  <p><?php echo $text_terms; ?> <a href="https://www.opencartmaster.com.br/<?php echo $text_l; ?>" target="_blank"><?php echo $text_t; ?></a></p>
            </div>
          </div>
		</div>
           
       <div class="tab-pane" id="tab-help">
	     <fieldset>
       <legend><?php echo $text_h; ?></legend>
       <h4><i class="fa fa-code"></i> <?php echo $module_name; ?> - <?php echo $version; ?> </h4>
       <h4><i class="fa fa-envelope"></i> <a href="mailto:suporte@opencartmaster.com.br">suporte@opencartmaster.com.br</a></h4>
       <h4><i class="fa fa-whatsapp"></i> <a href="https://wa.me/551142542450" target="_blank">11 4254-2450</a></h4>
       <h4><i class="fa fa-globe"></i><a href="https://opencartmaster.com.br" target="_blank">opencartmaster.com.br</a></h4>
	     <p><?php echo $text_support; ?></p>
       </fieldset>
	     </div>
		 
		</div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 