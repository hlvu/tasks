/* eslint-disable */
$(document).ready(function() {
    $("#addBtn").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          type: 'POST',
          url: '/tasks',
          data: {
            name: $("#newTaskForm input[name=name]").val(),
            task: $("#newTaskForm input[name=task]").val(), 
          },
          dataType: 'json',
          success: function(result) {
            alert(result.success);
          }
        });
      });
    });