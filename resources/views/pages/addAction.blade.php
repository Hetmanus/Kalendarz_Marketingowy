@extends('pages/_layout')

@section('css')
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@stop

@section('script')
<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="/bower_components/moment/min/moment.min.js"></script>
<script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/plugins/iCheck/icheck.min.js"></script>
@stop

@section('content')
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        General Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Add Action</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dodaj Akcję</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- select -->
                <div class="form-group">
                  <label>Koncept</label>
                  <select class="form-control" id="concept" onchange="onConceptChange()">
                    @for($i = 0; $i < count($concepts); $i++)
                    <option value="{{$i}}">{{ $concepts[$i] }}</option>
                    @endfor
                  </select>
                </div>

                <!-- Select multiple-->
                <div class="form-group">
                    <label>Sklepy</label>
                    <select multiple="" id="shops" class="form-control">
                        @foreach($shops[0] as $shp)
                        <option>{{$shp}}</option>
                        @endforeach
                    </select>
                  </div>

                <!-- text input -->
                <div class="form-group">
                  <label>Nazwa Akcji</label>
                  <input type="text" class="form-control" placeholder="Nazwa ...">
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Opis Akcji</label>
                  <textarea class="form-control" rows="3" placeholder="Opis ..."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Okres Trwania Akcji:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationtime">
                    </div>
                    <!-- /.input group -->
                  </div>
                <div class="box box-success" style="margin-bottom:0;">
                    <div class="box-header with-border">
                      <h3 class="box-title">Budżet</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4"></div>
                        <h3 class="col-xs-4" style="margin:0">Budżet <b>Online</b>: <div id="budg_on_sum">0.00</div> PLN</h3>
                        <h3 class="col-xs-4" style="margin:0">Budżet <b>Offline</b>: <div id="budg_off_sum">0.00</div> PLN</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">Media Zewnętrzne</div>
                        <div class="col-xs-4">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="0.00" id="budg_on_MZ" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                            </div>
                          </div>
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="0.00"id="budg_off_MZ" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                          </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">Reklama Zewnętrzna i Usługi</div>
                        <div class="col-xs-4">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="0.00" id="budg_on_RZiU" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                            </div>
                          </div>
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="0.00" id="budg_off_RZiU" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                          </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">Reklama i Materiały Wewnętrzene</div>
                        <div class="col-xs-4">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="0.00" id="budg_on_RiMW" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                            </div>
                          </div>
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="0.00" id="budg_off_RiMW" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                          </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">e-commerce</div>
                        <div class="col-xs-4">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="0.00" id="budg_on_EC" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                            </div>
                          </div>
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="0.00" id="budg_off_EC" onkeyup="recalculateBudget()"><span class="input-group-addon">PLN</span>
                          </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-2">Dostępne Środki: <div id="budg_full">{{$budget}}</div> PLN</div>
                        <div class="col-xs-2">Pełen Budżet Akcji: <div id="budg_action">0.00</div> PLN</div>
                        <div class="col-xs-2">Pozostaje: <div id="budg_left">0.00</div> PLN</div>
                      </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Sign in</button>
                  </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Page script -->
<script>
    function onConceptChange() 
    {
      var shops = {!! json_encode($shops) !!};
      //var shops = JSON.parse("{!! json_encode($shops) !!}");
      var converted;
      var sel = document.getElementById("concept");
      //shops.forEach(element => {
        for(i = 0; i < shops[sel.selectedIndex].length; i++)
        {
          converted += "<option>" + shops[sel.selectedIndex][i] + "</option>";
        }
      //});
      document.getElementById("shops").innerHTML = converted;
    }
    function recalculateBudget()
    {
      var budg_on_MZ = document.getElementById("budg_on_MZ");
      var budg_off_MZ = document.getElementById("budg_off_MZ");
      var budg_on_RZiU = document.getElementById("budg_on_RZiU");
      var budg_off_RZiU = document.getElementById("budg_off_RZiU");
      var budg_on_RiMW = document.getElementById("budg_on_RiMW");
      var budg_off_RiMW = document.getElementById("budg_off_RiMW");
      var budg_on_EC = document.getElementById("budg_on_EC");
      var budg_off_EC = document.getElementById("budg_off_EC");

      var budg_on_sum = document.getElementById("budg_on_sum");
      var budg_off_sum = document.getElementById("budg_off_sum");

      var budg_full = document.getElementById("budg_full");
      var budg_action = document.getElementById("budg_action");
      var budg_left = document.getElementById("budg_left"); 

      var budg_on_sum_val = (parseInt(budg_on_MZ.value) || 0) + (parseInt(budg_on_RZiU.value) || 0) + (parseInt(budg_on_RiMW.value) || 0) + (parseInt(budg_on_EC.value) || 0);
      var budg_off_sum_val = (parseInt(budg_off_MZ.value) || 0) + (parseInt(budg_off_RZiU.value) || 0) + (parseInt(budg_off_RiMW.value) || 0) + (parseInt(budg_off_EC.value) || 0);
      var budg_action_val = budg_on_sum_val + budg_off_sum_val;
      var budg_left_val = (parseInt(budg_full.innerHTML) || 0) - budg_action_val;

      //document.write(budg_on_sum_val + "<br>" + budg_off_sum_val + "<br>" + budg_action_val + "<br>" + budg_left_val + "<br>");

      budg_on_sum.innerHTML = budg_on_sum_val;
      budg_off_sum.innerHTML = budg_off_sum_val;
      budg_action.innerHTML = budg_action_val;
      budg_left.innerHTML = budg_left_val;
    }
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ locale: {
      format: 'YYYY/MM/DD HH:mm:ss'
      }, 
      timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A' })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'))
        }
      )
  
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
  
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })
  
      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()
  
      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
    window.onload = recalculateBudget;
  </script>
@stop
