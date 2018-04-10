
$(document).ready(function ($) {

  $('#employee_tree').on('click', '.disclose', function () {
    var $this = $(this);
    var $parent = $this.parent();
    var $ol = $('ol', $parent);
    var id = $this.data('target').split('_').pop();

    $this.text(($this.text().trim() === '+') ? '-' : '+');

    if (!$ol.length) {
      $.ajax({
        url: '/employees/employee/' + id + '/tree/item/children',
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

});
