@extends('layouts.app')

@php
/**
 * @var \nojes\employees\Models\Employee[] $employees
 */

@endphp

@section('content')
    <div class="container">
        <div class="row">
            @include('employees::backend.sidebar')
        </div>

        <div class="row">

            {{--<ol class="sortable">--}}
                {{--<li><div>Some content</div></li>--}}
                {{--<li>--}}
                    {{--<div>Some content</div>--}}
                    {{--<ol>--}}
                        {{--<li><div>Some sub-item content</div></li>--}}
                        {{--<li><div>Some sub-item content</div></li>--}}
                    {{--</ol>--}}
                {{--</li>--}}
                {{--<li><div>Some content</div></li>--}}
            {{--</ol>--}}


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Employees</div>
                    <div class="panel-body">
                        <button class="btn btn-success pull-right to-array"><i class="fa fa-save"></i> Save </button>

                        <br>
                        <br>

                        <div class="col-md-12">
                            <ol class="sortable">
                                @include('employees::backend.employee.tree.items', compact($employees))
                            </ol>

                            <button class="btn btn-success pull-right to-array" data-style="zoom-in"><i class="fa fa-save"></i> Save </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{ url('jquery.mjs.nestedSortable.js) }}" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function ($) {
        $('.sortable').nestedSortable({
          handle: 'div',
          items: 'li',
          toleranceElement: '> div',
          isTree: true
        });
      });

      $('.to-array').click(function(e){
        items = $('ol.sortable').nestedSortable('toArray');
        // console.log(items);

        $.ajax({
          url: 'tree/update',
          type: 'POST',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            items: items
          }
        })
          .done(function() {
            console.log("success");
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });

      });

      $.ajaxPrefilter(function(options, originalOptions, xhr) {
        var token = $('meta[name="csrf-token"]').attr('content');

        if (token) {
          return xhr.setRequestHeader('X-XSRF-TOKEN', token);
        }
      });
    </script>
@endsection
