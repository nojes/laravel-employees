@extends('employees::backend.layout')

@php
/**
 * @var \nojes\employees\Models\Employee[] $employees
 */
@endphp

@section('employees::content')
    <div class="panel panel-default">
        <div class="panel-heading">Employees</div>
        <div class="panel-body">
            <button class="btn btn-success pull-right to-array"><i class="fa fa-save"></i> Save</button>
            <br><br>

            <div class="col-md-12">
                <div class="row">
                    <ol class="sortable">
                        @include('employees::backend.employee.tree.items', compact($employees))
                    </ol>

                    <button class="btn btn-success pull-right to-array"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/nojes/employees/plugins/nestedSortable/jquery.mjs.nestedSortable.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function ($) {

        $('.sortable').nestedSortable({
          forcePlaceholderSize: true,
          handle: 'div',
          helper: 'clone',
          items: 'li',
          opacity: .6,
          placeholder: 'placeholder',
          revert: 250,
          tabSize: 25,
          tolerance: 'pointer',
          toleranceElement: '> div',

          isTree: true,
          expandOnHover: 700,
          startCollapsed: false
        });



        $('.to-array').click(function (e) {
          var items = $('ol.sortable').nestedSortable('toArray');
          // console.log(items);

          $.ajax({
            url: 'tree/update',
            type: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              items: items
            }
          })
            .done(function () {
              console.log("success");
            })
            .fail(function () {
              console.log("error");
            })
            .always(function () {
              console.log("complete");
            });

        });

        $.ajaxPrefilter(function (options, originalOptions, xhr) {
          var token = $('meta[name="csrf-token"]').attr('content');

          if (token) {
            return xhr.setRequestHeader('X-XSRF-TOKEN', token);
          }
        });

      });

    </script>
@endpush
