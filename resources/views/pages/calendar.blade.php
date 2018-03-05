@extends('pages/_layout')

@section('css')
  <!-- fullCalendar -->
  <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
@stop

@section('script')
<!-- fullCalendar -->
<script src="/bower_components/moment/moment.js"></script>
<script src="/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
@stop

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendar
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calendar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	<div class="col-md-12">
        	<div class="box box-success" style="margin-bottom:0;">
        		<div class="box-header with-border">
                      		<h3 class="box-title">Kalendarz</h3>
                    	</div>
                    	<div class="box-body">
				<div class="col-xs-1"></div>
				<label>Koncepty</label>
				<div>
				<div class="col-xs-1"></div>
				@for($i = 0; $i < count($concepts); $i++)
				<div class="col-xs-1">
				  <div class="checkbox">
				    <label>
					@if(($conceptFlag & 1 << $i) != 0)
				      	<input type="checkbox" onclick="conceptFlag()" checked id="concept_{!!$i!!}" value="{!!$i!!}">{{$concepts[$i]}}
				    	@else
					<input type="checkbox" onclick="conceptFlag()" id="concept_{!!$i!!}" value="{!!$i!!}">{{$concepts[$i]}}
					@endif
					</label>
				  </div>
				</div>
				@endfor
				</div>
		      
			<!-- /.col -->
				<div class="col-md-12">
				  <div class="box box-primary">
				    <div class="box-body no-padding">
				      <!-- THE CALENDAR -->
				      <div id="calendar"></div>
				    </div>
				    <!-- /.box-body -->
				  </div>
				  <!-- /. box -->
				</div>
				<!-- /.col -->
                    </div>
</div>
</div>
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Page specific script -->
<script>
function conceptFlag()
    {
	var flag = 0;
	@for($i = 0; $i < count($concepts); $i++)
		if(document.getElementById("concept_{!!$i!!}").checked == true)
		{
			flag += 1 << {!!$i!!};
		}
	@endfor     
	//document.write(flag);
	window.location.href = flag; 
    }
        $(function () {
      
          /* initialize the external events
           -----------------------------------------------------------------*/
          function init_events(ele) {
            ele.each(function () {
      
              // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
              // it doesn't need to have a start or end
              var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
              }
      
              // store the Event Object in the DOM element so we can get to it later
              $(this).data('eventObject', eventObject)
      
              // make the event draggable using jQuery UI
              $(this).draggable({
                zIndex        : 1070,
                revert        : true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
              })
      
            })
          }
      
          init_events($('#external-events div.external-event'))
      
          /* initialize the calendar
           -----------------------------------------------------------------*/
          //Date for the calendar events (dummy data)
          var date = new Date()
          var d    = date.getDate(),
              m    = date.getMonth(),
              y    = date.getFullYear()
          $('#calendar').fullCalendar({
            header    : {
              left  : 'prev,next today',
              center: 'title',
              right : 'month,agendaWeek,agendaDay'
            },
            buttonText: {
              today: 'dziś',
              month: 'miesiąc',
              week : 'tydzień',
              day  : 'dzień'
            },
            //Random default events
            events    : [
		@for($i = 0; $i < count($conceptsActions); $i++)
			@if(($conceptFlag & 1 << $i) != 0)
				@foreach($conceptsActions[$i] as $act)
				      {
					title          : '{!!$act[0]!!}',
					start          : new Date({!!$act[1]!!}),
					end            : new Date({!!$act[2]!!}),
					allDay         : {!!$act[3]!!},
					url            : 'calendar/{!!$act[4]!!}',
					backgroundColor: '{!!$act[5]!!}',
					borderColor    : '{!!$act[6]!!}'
				      },
				@endforeach
			@endif
		@endfor
            ],
            editable  : false,
            droppable : false, // this allows things to be dropped onto the calendar !!!
            drop      : function (date, allDay) { // this function is called when something is dropped
      
              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject')
      
              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject)
      
              // assign it the date that was reported
              copiedEventObject.start           = date
              copiedEventObject.allDay          = allDay
              copiedEventObject.backgroundColor = $(this).css('background-color')
              copiedEventObject.borderColor     = $(this).css('border-color')
      
              // render the event on the calendar
              // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
              $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)
      
              // is the "remove after drop" checkbox checked?
              if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove()
              }
      
            }
          })
      
          /* ADDING EVENTS */
          var currColor = '#3c8dbc' //Red by default
          //Color chooser button
          var colorChooser = $('#color-chooser-btn')
          $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
          })
          $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
              return
            }
      
            //Create events
            var event = $('<div />')
            event.css({
              'background-color': currColor,
              'border-color'    : currColor,
              'color'           : '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)
      
            //Add draggable funtionality
            init_events(event)
      
            //Remove event from text input
            $('#new-event').val('')
          })
        })
      </script>
@stop
