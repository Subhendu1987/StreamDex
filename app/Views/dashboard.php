<?php include('include/header.php'); ?>
<style>
tspan {
    fill: #000000;
    color: #000000;
}
.fs-6.fw-normal{
  fill: #000000;
    color: #000000;
}

</style>
<div class="body flex-grow-1" >
        <div class="row scrollable-div px-4">
           



         <div class="row g-4 mb-4">



         <!-- <div class="col-sm-12 col-lg-12"> -->
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white "style="background-color: #3b5998 !important">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">CPU</div>
                  </div>                  
                </div>
                <div id="cpugauge" class="gauge size-1 "></div>
                <div class="text-center"><span class="fs-6 fw-normal" id="cpuModel"></span></div>                
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white " style="background-color: rgb(50 121 191) !important">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">RAM</div>
                  </div>
                  
                </div>
                <div id="ramgauge" class="gauge size-1 "></div>
                <div class="text-center"><span class="fs-6 fw-normal" id="ramUsage"></span></div> 
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white " style="background-color: rgb(187 138 31) !important">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Storage</div>
                  </div>
                  
                </div>
                <div id="storagegauge" class="gauge size-1 "></div>
                <div class="text-center"><span class="fs-6 fw-normal" id="storageUsage"></span></div> 
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div class="card text-white" style="background-color: rgb(183 79 79) !important";>
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Network</div>
                  </div>
                  
                </div>
                <div id="networkgauge" class="gauge size-1 "></div>
                <div class="text-center"><span class="fs-6 fw-normal" id="networkuses"></span></div> 
              </div>
            </div>
            <!-- </div> -->


            <div class="col-sm-12 col-lg-12">
              <div class="card " >
                <div class="card-header position-relative d-flex justify-content-center align-items-center bg-info">
                <div class="fs-4 fw-semibold">System Information</div>
                  <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                    <canvas id="social-box-chart-1" height="90"></canvas>
                  </div>
                </div>
                <div class="card-body row text-center">
                  <div class="col">
                    <div class="fs-6 fw-semibold">System Uptime</div>
                    <div class="text-uppercase text-body-secondary small" id = "sys_uptime">Please Wait...</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-6 fw-semibold">System Cpu Core</div>
                    <div class="text-uppercase text-body-secondary small" id="sys_temp">Please Wait...</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-6 fw-semibold">System Traffic</div>
                    <div class="text-uppercase text-body-secondary small" id="sys_trfc">Please Wait...</div>
                  </div>
                  <div class="vr"></div>
                  <div class="col">
                    <div class="fs-6 fw-semibold">System Process</div>
                    <div class="text-uppercase text-body-secondary small" id="sys_proc">Please Wait...</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-4 col-sm-12 col-lg-12">
              <div class="card " >
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="row">
                        
                        <div class="col-4">
                          <div class="card" style="--cui-card-cap-bg: rgb(183 79 79) !important;">
                            <div class="card-header position-relative d-flex justify-content-center align-items-center">
                            <div class="col-6 text-center">
                              <div class="text-uppercase text-body-secondary small" style="color: #000000 !important;">Total Videos</div>
                              <div class="fs-6 fw-semibold" style="color: #000000 !important;" id = "tovi">0</div>                              
                            </div>
                            </div>
                            <div class="card-body row text-center">
                              <div class="col">
                                <div class="fs-5 fw-semibold"id = "tosz">0</div>
                                <div class="text-uppercase text-body-secondary small">Total Size</div>
                              </div>
                              <div class="vr"></div>
                              <div class="col">
                                <div class="fs-5 fw-semibold"id = "toln">0</div>
                                <div class="text-uppercase text-body-secondary small">Total Length</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="card" style="--cui-card-cap-bg: rgb(187 138 31) !important;">
                            <div class="card-header position-relative d-flex justify-content-center align-items-center" >
                            <div class="col-6 text-center" >
                              <div class="text-uppercase text-body-secondary small" style="color: #000000 !important;">Music Videos</div>
                              <div class="fs-6 fw-semibold" style="color: #000000 !important;" id= "tmv">0</div>                              
                            </div>
                            </div>
                            <div class="card-body row text-center">
                              <div class="col">
                                <div class="fs-5 fw-semibold" id= "toad">0</div>
                                <div class="text-uppercase text-body-secondary small">Total Audio</div>
                              </div>
                              <div class="vr"></div>
                              <div class="col">
                                <div class="fs-5 fw-semibold" id= "tlnk">0</div>
                                <div class="text-uppercase text-body-secondary small">RTMP Links</div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="col-4">
                          <div class="card" style="--cui-card-cap-bg: rgb(50 121 191) !important">
                            <div class="card-header position-relative d-flex justify-content-center align-items-center" >
                            <div class="col-6 text-center" >
                              <div class="text-uppercase text-body-secondary small" style="color: #000000 !important;">Total Playlists</div>
                              <div class="fs-6 fw-semibold" style="color: #000000 !important;" id= "plcnt">0</div>                              
                            </div>
                            </div>
                            <div class="card-body row text-center">
                              <div class="col">
                                <div class="fs-5 fw-semibold" id= "pldur">0</div>
                                <div class="text-uppercase text-body-secondary small">Total Duration</div>
                              </div>
                              <div class="vr"></div>
                              <div class="col">
                                <div class="fs-5 fw-semibold" id= "pllnk">0</div>
                                <div class="text-uppercase text-body-secondary small">RTMP Links</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.col-->
     
                    
                        
                      </div>
             
                    </div>
                    <!-- /.col-->

                  </div>
     
                </div>
              </div>
            </div>


            
          </div>













            

        </div>











</div>    
<?php include('include/footer.php'); ?>
<script>
        // Initialize gauges
        var defstyle = {
            pointer: true,            
            pointerOptions: {
            toplength: -15,
            bottomlength: 10,
            bottomwidth: 12,
            color: '#8e8e93',
            stroke: '#ffffff',
            stroke_width: 3,
            stroke_linecap: 'round'
            },
            counter: true
        }
        var cpuGauge = new JustGage({
            id: "cpugauge",
            value: 0,
            min: 0,
            max: 100,
            label: "CPU Load",
            defaults: defstyle,
            textRenderer: function (val) {
                return (Math.round(val) + '%');
            }
        });
        var ramGauge = new JustGage({
            id: "ramgauge",
            value: 0,
            min: 0,
            max: 100,
            label: "RAM Usage",
            defaults: defstyle,
            textRenderer: function (val) {
                return (Math.round(val) + '%');
            }
        });
        var storageGauge = new JustGage({
            id: "storagegauge",
            value: 0,
            min: 0,
            max: 100,
            label: "Storage Usage",            
            defaults: defstyle,
            textRenderer: function (val) {
                return (Math.round(val) + '%');
            }
        });
        var networkgauge = new JustGage({
            id: "networkgauge",
            value: 0,
            min: 0,
            max: 100,
            label: "Network",
            defaults: defstyle,
            textRenderer: function (val) {
                return (parseFloat(Number(val).toFixed(2)) + ' Mbps');
            }
        });


        $(document).ready(function() {
            function fetchSystemStatus() {
                $.ajax({
                    url: '<?= base_url('user/system') ?>',
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        cpuGauge.refresh(response.cpu * 10);
                        ramGauge.refresh((Number(response.ram.used) / Number(response.ram.total)) * 100);
                        storageGauge.refresh(((parseFloat(response.storage.used)) + (parseFloat(response.storage.available))) > 0  ? ((parseFloat(response.storage.used)) / ((parseFloat(response.storage.used)) + (parseFloat(response.storage.available)))) * 100 : 0);
                        networkgauge.refresh((response.network.network / (1024 * 1024)).toFixed(2));
                        $('#cpuModel').text(response.cpu_model.substring(0,31));
                        $('#ramUsage').text(response.ram.used + ' MB / ' + response.ram.total + ' MB');
                        $('#storageUsage').text(response.storage.used + 'B / ' + response.storage.available+'B');
                        $('#networkuses').text('Total Uses : ' + response.network_uses);

                        
                        $('#sys_uptime').text(response.uptime);
                        $('#sys_temp').text(response.cpucount + ' Cores');                        
                        $('#sys_trfc').text(response.network.network + ' bytes');
                        $('#sys_proc').text(response.processes + ' Process');

                        $('#tovi').text(response.totalvid);
                        $('#toln').text(response.totallnt);
                        $('#tosz').text(response.totalsiz);

                        $('#plcnt').text(response.totalpl);
                        $('#pldur').text(response.totalpl_ln);
                        $('#pllnk').text(response.totallnk);

                        $('#tmv').text(response.totalmv);
                        $('#toad').text(response.totalmvaud);
                        $('#tlnk').text(response.totamvllnk);
                    }
                });
            }
            fetchSystemStatus();
            setInterval(fetchSystemStatus, 5000);
        });






    </script>
    