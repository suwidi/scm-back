<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';?>
          <div class="row">
            <?php  if ( \Yii::$app->user->can('LpseAdmin')){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
               <a href="?r=mlpse" class="small-box bg-aqua">
              <div class="small-box bg-aqua">               
                <div class="inner">
                  <h3>LPSE</h3>
                  <p>Administrasi LPSE<br>--</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>             
                <div class="small-box-footer">Open<i class="fa fa-arrow-circle-right"></i></div>                
              </div>
               </a>
            </div><!-- ./col -->
              <?php } ?>
              <?php  if ( \Yii::$app->user->can('CloudAdmin')){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <a href="?r=mcloud" class="small-box bg-green">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Cloud<sup style="font-size: 20px"></sup></h3>
                  <p><ul><li><?=$order['custs']?> New Customers</li>
                    <li><?=$order['apps']?> New Orders</li>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <div class="small-box-footer">Open<i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </a>
            </div><!-- ./col -->
            <?php } ?>
              <?php  if ( \Yii::$app->user->can('LpseApps')){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <a href="#" class="small-box bg-yellow">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>LPSE Apps</h3>
                  <p>Maintenance Your Subscription</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <div class="small-box-footer">Open<i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </a>
            </div><!-- ./col -->
             <?php } ?>
              <?php  if ( \Yii::$app->user->can('CloudApps')){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <a href="?r=cloudapp" class="small-box bg-red">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Apps</h3>
                  <p>Access Your Clouds Apps</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
               <div class="small-box-footer">Open<i class="fa fa-arrow-circle-right"></i></div>
              </div>
            </div>
          </a>
          <!-- ./col -->
             <?php } ?>
          </div><!-- /.row -->
          <!-- Main row -->
          
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ticket</h3>
                  <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                    <div class="btn-group" data-toggle="btn-toggle" >
                      <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                    </div>
                  </div>
                </div>
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  <div class="item">
                    <img src="img/avatar.png" alt="user image" class="online"/>
                    <p class="message">
                      <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                        Administrator
                      </a> Silahkan download template data migration
                    </p>
                    <div class="attachment">
                      <h4>Attachments:</h4>
                      <p class="filename">
                        excel-hcm-template.xls
                      </p>
                      <div class="pull-right">
                        <button class="btn btn-primary btn-sm btn-flat">Download</button>
                      </div>
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->               

              </div><!-- /.box (chat box) -->

              <!-- TO DO List -->
         
              <!-- quick email widget -->
      

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                    <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->
                  <i class="fa fa-map-marker"></i>
                  <h3 class="box-title">
                   Login History
                  </h3>
                </div>
                <div class="box-body">
                  <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border">
                  <div class="row">
                    <div class="text-center" style="border-right: 1px solid #f4f4f4">
                      <div id="sparkline-1"></div>
                      <div class="knob-label">Log data login anda ke cloud Cubiconia.com</div>
                    </div><!-- ./col -->          
                  </div><!-- /.row -->
                </div>
              </div>
              <!-- /.box -->
               <!-- Calendar -->
              <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendar</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">No Menus</a></li>               
                        <li class="divider">--</li>
                       
                      </ul>
                    </div>
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div><!-- /.box-body -->
                <div class="box-footer text-black">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- Progress bars -->
                      <div class="clearfix">
                        <span class="pull-left">Upload Data migrasi</span>
                        <small class="pull-right">0%</small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 1%;"></div>
                      </div>                      
                    </div><!-- /.col -->
           
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.box -->

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

    