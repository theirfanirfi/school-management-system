<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo ucfirst('invoice/payment_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo ucfirst('add_invoice/payment');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo ucfirst('student');?></div></th>
                    		<th><div><?php echo ucfirst('title');?></div></th>
                            <th><div><?php echo ucfirst('total');?></div></th>
                            <th><div><?php echo ucfirst('paid');?></div></th>
                    		<th><div><?php echo ucfirst('status');?></div></th>
                    		<th><div><?php echo ucfirst('date');?></div></th>
                    		<th><div><?php echo ucfirst('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <?php if ($row['due'] != 0):?>

                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-bookmarks"></i>
                                                <?php echo ucfirst('take_payment');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <?php endif;?>
                                    
                                    <!-- VIEWING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-credit-card"></i>
                                                <?php echo ucfirst('view_invoice');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- EDITING LINK -->
                                    <!-- <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo ucfirst('edit');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li> -->

                                    <!-- DELETION LINK -->
                                    <!-- <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo ucfirst('delete');?>
                                            </a>
                                                    </li> -->
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
            <?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo ucfirst('invoice_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('student');?></label>
                                    <div class="col-sm-9">
                                        <select name="student_id" class="form-control" style="" >
                                            <?php 
                                            $this->db->order_by('class_id','asc');
                                            $students = $this->db->get('student')->result_array();
                                            foreach($students as $row):
                                            ?>
                                                <option value="<?php echo $row['student_id'];?>">
                                                    class <?php echo $this->crud_model->get_class_name($row['class_id']);?> -
                                                    roll <?php echo $row['roll'];?> -
                                                    <?php echo $row['name'];?>
                                                </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('title');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="title"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('description');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description"/>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('reference');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="reference"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('date');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="datepicker form-control" name="date"/>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo ucfirst('payment_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('total');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo ucfirst('enter_total_amount');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo ucfirst('enter_payment_amount');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="paid"><?php echo ucfirst('paid');?></option>
                                            <option value="unpaid"><?php echo ucfirst('unpaid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php echo ucfirst('cash');?></option>
                                            <option value="2"><?php echo ucfirst('check');?></option>
                                            <option value="3"><?php echo ucfirst('card');?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo ucfirst('add_invoice');?></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close();?>
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

