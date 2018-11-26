<?php $this->load->view('header');?>


    <style>
  .GaugeMeter{
    Position:        Relative;
    Text-Align:      Center;
    Overflow:        Hidden;
    Cursor:          Default;
  }

  .GaugeMeter SPAN,
  .GaugeMeter B{
    Margin:          0 23%;
    Width:           54%;
    Position:        Absolute;
    Text-align:      Center;
    Display:         Inline-Block;
    Color:           RGBa(0,0,0,.8);
    Font-Weight:     100;
    Font-Family:     "Open Sans", Arial;
    Overflow:        Hidden;
    White-Space:     NoWrap;
    Text-Overflow:   Ellipsis;
  }

  .GaugeMeter {
      margin: auto;
      width: 50%;
      padding: 10px;
  }
  .GaugeMeter[data-style="Semi"] B{
    Margin:          0 10%;
    Width:           80%;
  }

  .GaugeMeter S,
  .GaugeMeter U{
    Text-Decoration: None;
    Font-Size:       .5em;
    Opacity:         .5;
  }

  .GaugeMeter B{
    Color:           Black;
    Font-Weight:     300;
    Font-Size:       .5em;
    Opacity:         .8;
  }
  
  .box-footer{
	 background-color:#209dc6;
	  color:white
  }
  
  .box-footer a{
	 // background-color:#e24341;
	  color:white
  }
  .box-body{
	  min-height: 80px;
  }
  
  .val-square{
	  border:1px solid #67c89c;
	  border-radius:5px;
	  width:100%;
	  //padding:10px 0px 10px 0px 
	  height:100%;
  }
  
  .val-square-header{
		width:100%;
		height:35px;
		border-bottom:1px solid #67c89c;
		text-align:center;
		padding: 7px;
		color: #fff;
		font-size: 15px;
		background: #67c89c;
	  
  }
  
  .val-square-body{
		width:100%;
		height:25px;
		text-align:center;
		min-height: 100px;
		font-size: 25px;
		font-weight: 700;
		padding-top: 20px;
	}
	.box-body .box-header{
	  text-align:center;
	}
	
	.square-green{
		background-color:#c0efd8;
	}
	
	.square-merah  {
		background-color:#ff8989;
		border-color:#f33a3a;
	}
	
	.square-merah   .val-square-header{
		background-color:#f33a3a;
	}
	
	.square-lightbrown {
		background-color:antiquewhite;
		border-color:#efb467;
	}
	
	.square-lightbrown  .val-square-header{
		background-color:#efb467;
	}
	
	.square-lightgray  {
		background-color:#e4e0e0;
		border-color:#8d8d8d;
	}
	
	.square-lightgray   .val-square-header{
		background-color:#8d8d8d;
	}
	
	.square-violete {
		background-color:#c39cf5;
		border-color:#8040d2;
	}
	
	.square-violete .val-square-header{
		background-color:#8040d2;
	}
	
	.square-lightblue {
		background-color:#77def5;
		border-color:#4fbdcf;
	}
	
	.square-lightblue .val-square-header{
		background-color:#4fbdcf;
	}
	
	.square-brown  {
		background-color:#edf3b2;
		border-color:#c3c12e;
	}
	
	.square-brown  .val-square-header{
		background-color:#c3c12e;
	}
  
  .glyphicon-refresh-animate {
		-animation: spin .7s infinite linear;
		-ms-animation: spin .7s infinite linear;
		-webkit-animation: spinw .7s infinite linear;
		-moz-animation: spinm .7s infinite linear;
	}

	@keyframes spin {
		from { transform: scale(1) rotate(0deg);}
		to { transform: scale(1) rotate(360deg);}
	}
	  
	@-webkit-keyframes spinw {
		from { -webkit-transform: rotate(0deg);}
		to { -webkit-transform: rotate(360deg);}
	}

	@-moz-keyframes spinm {
		from { -moz-transform: rotate(0deg);}
		to { -moz-transform: rotate(360deg);}
	}
</style>
  
 <!--  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  </div> -->
<div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					<h4 class="page-header">
						Overview
					</h4>
					<div class="row">
						<div class="form-group">
							<div class="col-md-3">
								<div class="input-group">
									<div class="input-group-addon" id="spinner">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" id="date_daily_product" value="<?php echo date('Y-m-d')?>">
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
				
				<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
				<div class="col-md-8">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-random"></i><h3 class="box-title">Daily Sales</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="col-md-12">
							<canvas id="myChart"></canvas>
						</div>
						<div class="col-md-6">
							<div class="box box-danger" style="border-top-color:#5abede !important;">
								<div class="box-header with-border">
								  <h3 class="box-title">Month To Date</h3>
								</div>
								<div class="box-body no-padding">
									<div class="col-md-12">
										<div id="monthly_transaksi"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box box-danger" style="border-top-color:#5abede !important;">
								<div class="box-header with-border">
								  <h3 class="box-title">Year To Date</h3>
								</div>
								<div class="box-body no-padding">
									<div class="col-md-12">
										<div id="yearly_transaksi"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="<?php echo base_url()?>/dashasahan/tools/debit-harian?d=1" class="uppercase">Detail Debit Harian <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
				<div class="col-md-4">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-random"></i><h3 class="box-title">Receiveable</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<canvas id="myChartLine"></canvas>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-random"></i><h3 class="box-title">Piutang Usaha</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<canvas id="myChartMultiBar"></canvas>
					</div>
					<!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="<?php echo base_url()?>/dashasahan/tools/water-level-toba?d=1" class="uppercase">Detail Water Level Toba <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
				<div class="col-md-6">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-hourglass-3"></i><h3 class="box-title">Daftar Akun Terpantau</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="col-md-12">
							<table class="table table-strips table-hover" id="example">
								<thead>
									<tr>
										<th>Akun</th>
										<th>Bulan Ini</th>
										<th>Tahun Ini</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Kas (1-1111)</td>
										<td>Rp. 0</td>
										<td>Rp. 0</td>
									</tr>
									<tr>
										<td>Petty Cash (1-1112)</td>
										<td>Rp. 0</td>
										<td>Rp. 0</td>
									</tr>
									<tr>
										<td>Bank MANDIRI (1-1124)</td>
										<td>Rp. 0</td>
										<td>Rp. 0</td>
									</tr>
									<tr>
										<td>Bank CIMBNIAGA (1-1125)</td>
										<td>Rp. 0</td>
										<td>Rp. 0</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
				<div class="col-md-6">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-gears"></i><h3 class="box-title">Biaya Operasional</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<canvas id="myChartRadar"></canvas>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
				<div class="col-md-6">
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-gears"></i><h3 class="box-title">Laba Rugi</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<canvas id="myChartDonut"></canvas>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
				<div class="col-md-4">
					  <!-- USERS LIST -->
				  <div class="box box-danger">
					<div class="box-header with-border">
					  <i class="fa fa-recycle"></i><h3 class="box-title">Pemeliharaan Sungai</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="col-md-6">
							<div class="box box-danger" style="border-top-color:#5abede !important;">
								<div class="box-header with-border">
								  <h3 class="box-title">Volume</h3>
								</div>
								<div class="box-body no-padding">
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-violete">
											<div class="val-square-body square-violete" id="volume_pelastik"></div>
											<div class="val-square-header"><label>Pelastik</label></div>
										</div>
									</div>
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-lightblue">
											<div class="val-square-body square-lightblue" id="volume_eceng"></div>
											<div class="val-square-header"><label>Eceng Gondok</label></div>
										</div>
									</div>
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-brown">
											<div class="val-square-body square-brown" id="volume_lain"></div>
											<div class="val-square-header"><label>Lain - Lain</label></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box box-danger" style="border-top-color:#5abede !important;">
								<div class="box-header with-border">
								  <h3 class="box-title">Pencapaian</h3>
								</div>
								<div class="box-body no-padding">
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-green">
											<div class="val-square-body square-green" id="pencapaian_plastik"></div>
											<div class="val-square-header"><label>Pelastik</label></div>
										</div>
									</div>
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-lightbrown">
											<div class="val-square-body square-lightbrown" id="pencapaian_eceng"></div>
											<div class="val-square-header"><label>Eceng Gondok</label></div>
										</div>
									</div>
									<div class="col-md-12" style="min-height:150px">
										<div class="val-square square-merah">
											<div class="val-square-body square-merah" id="pencapaian_lain"></div>
											<div class="val-square-header"><label>Lain - Lain</label></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="<?php echo base_url()?>/dashasahan/tools/volume-sampah?d=1" class="uppercase">Detail Kinerja Pemeliharaan Sungai <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					<!-- /.box-footer -->
				  </div>
				  <!--/.box -->
				</div>
		  </div>
	</div>
</section>
<?php $this->load->view('footer');?>

<?php
$cab1 = 0;
$cab2 = 0;

$month1 = 0;
$month2 = 0;
$total = $cab1+$cab2;

$total2 = $month1+$month2;
$target = $total2+3220000;
$total_ach = (($total2/$target)*100);

$total3 = ($total+3110000) * 12;
$target_year = $target*12;
$total_year_ach = (($total3/$target_year)*100);

?>
<script>
	$(document).ready(function(){
		
		
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Juni", "Juli", "Agustus", "September", "Oktober", "November"],
				datasets: [{
					label: '# of Sales',
					//data: [12, 19, 3, 5, 2, 3],
					data: [1244, 1942, 2322, 2312, 2319, 3544],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(215, 130, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(215, 130, 64, 1)'
				],
				yAxisID: 'y-axis-1',
				data: [13, 20, 5, 3, 5, 9, 2]
			}, {
				label: 'Dataset 2',
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(215, 130, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(215, 130, 64, 1)'
				],
				yAxisID: 'y-axis-2',
				data: [12, 19, 3, 5, 2, 3, 4]
			}]

		};
		
		window.onload = function() {
			
			var ctx = document.getElementById('myChartMultiBar').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Chart.js Bar Chart - Multi Axis'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							gridLines: {
								drawOnChartArea: false
							}
						}],
					}
				}
			});
			
			var ctx = document.getElementById('myChartDonut').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'pie',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Chart.js donut Chart - Multi Axis'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							gridLines: {
								drawOnChartArea: false
							}
						}],
					}
				}
			});
			
			
			var barChartDataRadar = {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: 'Dataset 1',
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
					],
					borderColor: [
					'rgba(255, 99, 132, 1)'
					],
					yAxisID: 'y-axis-1',
					data: [13, 20, 5, 3, 5, 9, 2]
				}, {
					label: 'Dataset 2',
					backgroundColor: [
						
						'rgba(153, 102, 255, 0.2)',
					],
					borderColor: [
					'rgba(255, 99, 132, 1)'
					],
					yAxisID: 'y-axis-2',
					data: [12, 19, 3, 5, 2, 3, 4]
				}]

			};
			
			var ctx = document.getElementById('myChartRadar').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'radar',
				data: barChartDataRadar,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Chart.js Radar Chart - Multi Axis'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							gridLines: {
								drawOnChartArea: false
							}
						}],
					}
				}
			});
		};
		
		var line = document.getElementById("myChartLine").getContext('2d');
		var myLineChart = new Chart(line, {
			type: 'line',
			data: {
				labels: ["Juni", "Juli", "Agustus", "September", "Oktober", "November"],
				datasets: [{
					label: '# of Votes',
					data: [1244, 1942, 1322, 1312, 1319, 944],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		//sungai -----------------------------------
		document.getElementById('volume_eceng').innerHTML = (0);
		document.getElementById('volume_pelastik').innerHTML = (0);
		document.getElementById('volume_lain').innerHTML = (0);
		document.getElementById('pencapaian_eceng').innerHTML = (0);
		document.getElementById('pencapaian_plastik').innerHTML = (0);
		document.getElementById('pencapaian_lain').innerHTML = (0);
		
		//$("#example").dataTable();
	});
</script>