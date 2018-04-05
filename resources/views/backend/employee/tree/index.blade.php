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
                    @include('employees::backend.employee.tree.items', compact($employees))

                    <button class="btn btn-success pull-right to-array"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/nojes/employees/js/plugins/nestedSortable/jquery.mjs.nestedSortable.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function ($) {

        var token = $('meta[name="csrf-token"]').attr('content');

        $('.sortable').nestedSortable({
            handle: 'div',
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

        $('#employee_tree').on('click', '.disclose', function() {
          var $this = $(this);
          var $parent = $this.parent();
          var $ol = $('ol', $parent);
          var id = $this.data('target').split('_').pop();

          $this.text(($this.text().trim() === '+') ? '-' : '+');

          if (!$ol.length) {
              $.ajax({
                url: '/employees/employee/'+id+'/tree/item/children',
                type: 'GET',
                dataType: 'html'
                // data: {htmlOptions: {id: 'collapse_'+id, class: 'collapse'}}
              })
                .done(function (items) {
                    $parent.append(items);
                    $('ol', $parent).toggleClass('in');
                })
                .fail(function (response) {
                  console.log(response);
                })
          }
        });

        $('.to-array').click(function (e) {
          var items = $('ol.sortable').nestedSortable('toArray');

          $.ajax({
            url: 'tree/update',
            type: 'POST',
            data: {
              _token: token,
              items: items
            }
          })
            .done(function (response) {
              console.log(response);
            })
            .fail(function (response) {
              console.log(response);
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
