@extends('layouts.user_type.auth')

@section('content')
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.css')}}">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kalendar Acara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pentadbir sistem</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <!-- /.card -->
                        <div class="">
                            {{-- <div class="card-header">
                              <h3 class="card-title">Cipta Acara</h3>
                          </div> --}}

                        @if(Auth::user()->access_code !=6)
                            <div class="pb-3">
                                <a href="{{route('admin.kalendar-laporan')}}" class="btn btn-block btn-primary">Laporan</a>
                            </div>
                        @endif
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Acara Akan Datang</h4>
                            </div>
                            <div class="card-body overflow-auto" style="max-height: 600px;">
                                <!-- the events -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    @foreach ($upcomingEvents as $event)
                                    <div class="time-label">
                                        <span class="">
                                            {{ \Carbon\Carbon::parse($event->tarikh)->format('j F. Y') }}
                                        </span>
                                    </div>
                                    <div>
                                        @if ($event->nama_acara)
                                            <i class="far fa-calendar-alt bg-blue"></i>
                                            
                                        @else
                                        <i class="fas fa-handshake bg-warning"></i>
                                        @endif

                                        <div class="timeline-item" style="display: flex; flex-direction:row; align-items:center; justify-content:space-between">

                                            <h3 class="timeline-header" style="border-bottom: none">
                                                <a href="#" onclick="openPopup('{{ route('admin.kalendar-butiran', [$event->id]) }}')">
                                                {{$event->nama_acara ? $event->nama_acara : $event->nama_mesyuarat }}</a>
                                                
                                            </h3>
                                            <h3 class="timeline-header" style="border-bottom: none">
                                                @if(Auth::user()->access_code !=6)
                                                <a href="{{route('admin.kalendar-delete-upcomming', [$event->id])}}" id="deleteEvent" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endif
                                            </h3>
                                            
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                    
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- jQuery UI -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/main.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.getElementById('deleteEvent').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default anchor behavior

        Swal.fire({
            title: 'Adakah anda pasti?',
            text: 'Anda akan memadam acara',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, pasti',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, navigate to the delete URL
                window.location.href = this.href;
            }
        });
    });
</script>

<script>
    function openPopup(url) {
        window.open(url, 'popupWindow', 'width=600, height=400, resizable=yes, scrollbars=yes');
    }
</script>


@if (Auth::user()->access_code === 6 )
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: {!! $events->map(function ($event) {
              return [
                  'title' => $event->nama_acara ? $event->nama_acara : $event->nama_mesyuarat,
                  'start' => $event->tarikh . 'T' . $event->masa_mula, // Combine date and time
                  'end' => $event->tarikh . 'T' . $event->masa_tamat, // Combine date and time
                  'backgroundColor' => $event->warna,
                  'borderColor' => $event->warna,
                  'allDay' => false,
                  'id' => $event->id, // Add the event ID
              ];
          })->toJson() !!},
          eventClick: function (info) {
              var eventId = info.event.id;
              var newWindow = window.open('{{ route('admin.kalendar-butiran', '') }}/' + eventId, 'Event Details', 'width=600, height=400, resizable=yes, scrollbars=yes');
              newWindow.focus();
          },
          themeSystem: 'bootstrap',
          headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          editable: true,
          droppable: true,
          locale: 'ms',
          drop: function (info) {
              if (checkbox.checked) {
                  info.draggedEl.parentNode.removeChild(info.draggedEl);
              }
          },

      });

      calendar.render();
  });
</script>
@else
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! $events->map(function ($event) {
                return [
                    'title' => $event->nama_acara ? $event->nama_acara : $event->nama_mesyuarat,
                    'start' => $event->tarikh . 'T' . $event->masa_mula, // Combine date and time
                    'end' => $event->tarikh . 'T' . $event->masa_tamat, // Combine date and time
                    'backgroundColor' => $event->warna,
                    'borderColor' => $event->warna,
                    'allDay' => false,
                    'id' => $event->id, // Add the event ID
                ];
            })->toJson() !!},
            eventClick: function (info) {
                var eventId = info.event.id;
                var newWindow = window.open('{{ route('admin.kalendar-butiran', '') }}/' + eventId, 'Event Details', 'width=600, height=400, resizable=yes, scrollbars=yes');
                newWindow.focus();
            },
            themeSystem: 'bootstrap',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            editable: true,
            droppable: true,
            locale: 'ms',
            drop: function (info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            
            dateClick: function (info) {
                var date = info.dateStr; // Get the clicked date
                var newWindow = window.open('{{ route('admin.kalendar-tambah', '') }}/' + date, 'Event Details', 'width=600, height=400, resizable=yes, scrollbars=yes');
                newWindow.focus();
            },
        });
  
        calendar.render();
    });
</script>
@endif

{{-- sweet alert --}}
@if (Session::get('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        icon: "success",
        title: "{{Session::get('success')}}"
    });

</script>

@endif


@endsection
