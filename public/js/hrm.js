$(function(){
  // Dynamic add/remove new skill input
  $('#add-skill').on('click', function(){
    var idx = Date.now();
    var html = '<div class="input-group mb-2 new-skill-item">'
      + '<input type="text" name="new_skills[]" class="form-control" placeholder="New skill name">'
      + '<button type="button" class="btn btn-danger remove-skill">Remove</button>'
      + '</div>';
    $('#new-skills-wrap').append(html);
  });

  $(document).on('click', '.remove-skill', function(){
    $(this).closest('.new-skill-item').remove();
  });

  // Department filter - AJAX
  $('#filter-department').on('change', function(){
    var dept = $(this).val();
    var url = '/employees/filter';
    $.get(url, { department_id: dept }, function(data){
      var rows = '';
      data.forEach(function(e){
        var skills = (e.skills || []).map(function(s){ return s.name }).join(', ');
        var deptName = e.department ? e.department.name : '';
        rows += '<tr>'+
                  '<td>'+e.id+'</td>'+
                  '<td>'+e.first_name+' '+e.last_name+'</td>'+
                  '<td>'+e.email+'</td>'+
                  '<td>'+deptName+'</td>'+
                  '<td>'+skills+'</td>'+
                  '<td>'+
                    '<a class="btn btn-sm btn-info" href="/employees/'+e.id+'">Show</a> '
                    +'<a class="btn btn-sm btn-warning" href="/employees/'+e.id+'/edit">Edit</a> '
                    +'<form method="POST" action="/employees/'+e.id+'" style="display:inline">'+
                      '<input type="hidden" name="_token" value="'+$('meta[name=csrf-token]').attr('content')+'">'+
                      '<input type="hidden" name="_method" value="DELETE">'+
                      '<button class="btn btn-sm btn-danger" onclick="return confirm(\'Delete?\')">Delete</button>'+
                    '</form>'+
                  '</td>'+
                '</tr>';
      });
      $('#employees-table tbody').html(rows);
    });
  });

  // Email uniqueness check (real-time)
  $('#email-field').on('blur', function(){
    var email = $(this).val();
    if (!email) return;
    var id = window.location.pathname.match(/employees\/(\d+)\/edit/) ? window.location.pathname.match(/employees\/(\d+)\/edit/)[1] : '';
    $.get('/employees/check-email', { email: email, id: id }, function(res){
      if (!res.unique) {
        $('#email-feedback').text('Email is already taken').show();
      } else {
        $('#email-feedback').hide();
      }
    });
  });
});
