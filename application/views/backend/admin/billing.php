<div class="row">
	<div class="col-md-12">
    
			
            	
		<div class="tab-content">
          
            
            
			<!----CREATION FORM STARTS---->
		
            <?php echo form_open(base_url() . 'index.php?admin/save_billing/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo ucfirst('Billing_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('class');?></label>
                                    <div class="col-sm-9">
                                        <select name="class_id" id="class_id" class="form-control" style="" >
                                            <option value=""> Select Class</option>
                                            <?php 
                                             $record_num = trim(end($this->uri->segment_array()));
                                             $classes = $this->db->get('class')->result_array();
                                            foreach($classes as $row):
                                            ?>
                                                <option value="<?php echo $row['class_id'];?>"  <?php if ($record_num == $row['class_id'] ) echo 'selected' ; ?>><?php echo $row['name'];?> </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('student');?></label>
                                    <div class="col-sm-9">
                                        <select name="student_id" class="form-control" style="" >
                                            <?php 
                                            //$this->db->order_by('class_id','asc');
                                            $record_num = trim(end($this->uri->segment_array()));
                                            
                                           if(!empty(is_numeric($record_num))){
                                                $this->db->where('class_id =',  $record_num);
                                                $students = $this->db->get('student')->result();
                                               // echo $this->db->last_query();
                                            //$students = $this->db->get_where('student', array('class_id' => $record_num));
                                                //print_r( $students);
                                            foreach($students as $rows):
                                            ?>
                                                <option value="<?php echo $rows->student_id;?>">
                                                    <?php echo $rows->name;?>  - Roll  <?php echo $rows->roll;?>
                                                </option>
                                            <?php
                                            endforeach;
                                        }  else { echo "<option>  No Student Found </option>"; }?>
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo ucfirst('type');?></label>
                                    <div class="col-sm-9">
                                        <select name="type" class="select form-control">
                                            <option value="monthly">Monthly</option>
                                            <option value="admission">Admission</option>
                                            <option value="miscellaneous">Miscellaneous</option>

                                        </select>
                                    </div>
                                </div>
                              <!--   <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php //echo ucfirst('description');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description"/>
                                    </div>
                                </div> -->

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
                                                            <div class=" col-md-offset-4 col-sm-5">
                                                                <button type="submit" class="btn btn-info"><?php echo ucfirst('add_Billing');?></button>
                                                            </div>
                                </div>
                            </div>
                        </div>
                          
                </div>
            <?php echo form_close();?>
			</div>
			
	</div>
</div>

<script type="text/javascript">
document.getElementById('class_id').onchange = function() {
    window.location = "http://localhost/sms/index.php?admin/billing/id/" + this.value;
};
</script>