@extends('layouts.app')

@section('main-content')
<div class="row justify-content-center">
    <div class="col-12">
      <!-- widgets -->
      <div class="row my-4">

          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-users text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class="small text-muted mb-0">Total Publisher</p>
                    <span class="h3 mb-0">{{ $users->count() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-bar-chart text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class="small text-muted mb-0">Total Post</p>
                    <span class="h3 mb-0">{{ $blogs->count() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-trending-up text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col">
                    <p class="small text-muted mb-0">Total View</p>
                    <span class="h3 mb-0">{{ $views }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row my-4">
        <div class="col-md-8 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title mb-0">Bar Chart</strong>

            </div>
            <div class="card-body">

              <canvas id="barChartjs" width="" height="365px" ></canvas>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /. col -->
        <div class="col-md-4 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title mb-0">Categorys Name</strong>

            </div>
            <div class="card-body" style="max-height: 400px;" >
                <table class="table datatables" style="max-height: 350px;
                display: block;
                overflow-x: auto;" id="">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category name</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count())
                            @foreach ($categories as $categorie )
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->name }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div>
      </div>

      <div class="row my-4">
        <!-- Striped rows -->

          <div class="col-md-12 mb-4">
            <div class="card shadow">
              <div class="card-body">
                <!-- table -->
                <div class="card-header">
                  <strong class="card-title">Filter</strong>
                </div>
                <div class="card-body" >

                  <div class=" ">

                      <div class="form-row" >


                        <div class="form-group col-md-3">
                          <label for="multi-select2">Admin</label>
                          <select class="form-control select2-multi user_name"  id="multi-select2">
                            <optgroup label="Admins">
                              @if ($users->isNotEmpty())
                              @foreach ($users as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                              @endif
                            </optgroup>
                          </select>
                        </div> <!-- form-group -->
                      
                        <div class="form-group col-md-3">
    <label for="select2Multiple">Category</label>
    <select class="form-control select2-multi post_category" id="select2Multiple" multiple>
        <optgroup label="Categories">
        <option value="all">All Categories</option> <!-- Add this option -->
        @if ($categories->isNotEmpty())
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        @endif
        </optgroup>
    </select>
</div>
                       
                        <div class="form-group col-md-3">
                          <label for="example-date">Start Date</label>
                          <input class="form-control start_date"  name="start_date" type="date" name="date">
                        </div>

                        <div class="form-group col-md-3">
                          <label for="example-date">End Date</label>
                          <input class="form-control end_date"  name="end_date" type="date" name="date">
                        </div>

                      </div>

                      <button type="button" class="btn btn-secondary float-right mr-2 clearbtn"><span class="fe fe-x fe-16 text-muted"></span></button>


                      <button type="button" class="btn btn-primary float-right mr-2 fiterbtn "><span class="fe fe-filter fe-16 text-muted"></span></button>

                  </div>
                </div> <!-- / .card-body -->


                <div class="table-data">
                  @include('table')
                </div>


              </div>
            </div>
          </div> <!-- simple table -->


      </div> <!-- .row-->

    </div> <!-- .col-12 -->

</div> <!-- .row -->
@endsection

@push('script')
<script src="{{ asset('assets/js/apps.js') }}"></script>
<script>
   $(document).on('click', '.fiterbtn', function(e){
    var user_count = $('.user_name').val();
    var category = $('.post_category').val();
    var start_date = $('.start_date').val();
    var end_date = $('.end_date').val();
    
    $('.lodder').removeClass('d-none');

    // If "All Categories" is selected, reset the category variable
    if (category.includes("all")) {
        category = []; // Clear the category selection to fetch all posts
    }

    $.ajax({
        url: "{{ route('filter.data') }}",
        type: "POST",
        data: {
            user: user_count,
            category: category,
            start_date: start_date,
            end_date: end_date,
            _token: '{{ csrf_token() }}'
        },
        success: function (data) {
            $('.lodder').addClass('d-none');
            $('.table-data').html(data);
        }
    });
});


$(document).on('click', '.clearbtn', function(e){
        $('.user_name').val(null).trigger('change'); // Clear multi-select
        $('.post_category').val(null).trigger('change'); // Clear category select
        $('.start_date').val(""); // Clear start date
        $('.end_date').val(""); // Clear end date
        $('.table-data').html(""); // Optionally clear table data
    });

</script>



<script type="text/javascript">
 $(document).ready(function () {
    var ChartOptions = {
        maintainAspectRatio: !1,
        responsive: !0,
        legend: { display: !1 },
        scales: {
            xAxes: [{ gridLines: { display: !1 } }],
            yAxes: [
                {
                    gridLines: {
                        display: !1,
                        color: colors.borderColor,
                        zeroLineColor: colors.borderColor,
                    },
                },
            ],
        },
    },

    ChartData = {
        labels: {!! json_encode($mounth) !!},
        datasets: [
            {
                label: 'category' ,
                barThickness: 10,
                backgroundColor: base.primaryColor,
                borderColor: base.primaryColor,
                pointRadius: !1,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: {!! json_encode($post_counts) !!},
                fill: "",
                lineTension: 0.1,
            },

        ],
    },

    barChartjs = document.getElementById("barChartjs");
barChartjs &&
    new Chart(barChartjs, {
        type: "bar",
        data: ChartData,
        options: ChartOptions,
    });

 });


</script>
@endpush
