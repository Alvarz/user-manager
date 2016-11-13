$(document).on('change', '#states', function(e) {
  e.preventDefault;
  var idProperty = $(this).data('id');
  var State = $('#states').val();
  var url = '/' + $(this).data('url');
  var param = '/' + idProperty + '/' + State;
  AjaxWithToken(url, param, '', 'PUT', function() {
    setTimeout(function() {
      location.reload();
    }, 3000);
  });
  return false;
});

$(document).on('click', '.del-property', function(e) {
  e.preventDefault;
  var r = confirm("You really want to delete this element?");

  if (r) {

    var idProperty = $(this).data('id');
    var url = '/api/properties';
    var param = '/' + idProperty;
    AjaxWithToken(url, param, '', 'DELETE', function() {
      setTimeout(function() {
        location.reload();
      }, 3000);
    });
  }
  return false;
});

$(document).on('submit', '#editProperty', function(e){
  e.preventDefault;
  var url = "/api/properties";
  var param = '/'+ $('#id').val();
  var data = $(this).serializeArray();
  console.log(data);
  AjaxCalls(url, param, data, 'PUT');
  return false;
});


$(document).on('submit', '#createProperty', function(e){
  e.preventDefault;
  var url = "/api/properties";
  var data = $(this).serializeArray();
  AjaxCalls(url, '', data, 'POST');
  return false;
});

$(document).on('click', '.statusBtn', function(e) {
  e.preventDefault;
  var id = $(this).data('id');
  var IdPlayer = $(this).data('idplayer');
  var Status = $(this).data('status');
  var PayMethod = $('#PayMethod').val();
  var url = (typeof $(this).data('url') == 'undefined') ? '/deposits' : '/' + $(this).data('url');
  var param = '/' + id + '/' + IdPlayer + '/' + Status + '/' + PayMethod;
  console.log(url);
  AjaxWithToken(url, param, '', 'PUT', function() {
    setTimeout(function() {
      location.reload();
    }, 3000);
  });
});


$(document).on('click', '.revokeAll', function(e) {
  e.preventDefault;
  var id = '/' + $(this).data('id');
  var url = '/' + $(this).data('url');

  AjaxWithToken(url, id, '', 'DELETE', function() {
    setTimeout(function() {
      location.reload();
    }, 3000);
  });
  return false;
})

$(document).on('submit', '#assign', function(e) {
  e.preventDefault;
  var url = '/' + $('#url').val();
  var id = '/' + $('#id').val();
  var data = $(this).serialize();
  AjaxCalls(url, id, data, 'POST', function() {
    setTimeout(function() {
      location.reload();
    }, 3000);
  });
  return false;
});

$(document).on("click", '.revoke', function(e) {

  e.preventDefault;
  var r = confirm("You really want to revoke this permission?");

  if (r == true) {

    var url = '/' + $(this).data('url');
    var idElement = '/' + $(this).data('idelement');
    var idToRevoke = '/' + $(this).data('idtorevoke');
    var param = idElement + idToRevoke;

    AjaxWithToken(url, param, '', 'DELETE', function() {
      setTimeout(function() {
        location.reload();
      }, 3000);
    });

  }
  return false;
});

$(document).on("click", '.delete', function(e) {

  e.preventDefault;
  var r = confirm("You really want to delete this element?");

  if (r == true) {

    var url = '/' + $(this).data('url');
    var id = '/' + $(this).data('id');
    AjaxWithToken(url, id, '', 'DELETE', function() {
      setTimeout(function() {
        location.reload();
      }, 3000);
    });

  }
  return false;
});


$(document).on('submit', '#creator', function(e) {

  e.preventDefault;
  var url = '/' + $('#url').val();
  var data = $(this).serialize();

  AjaxCalls(url, '', data, 'POST');

  return false;
});

$(document).on('submit', '#update', function(e) {

  e.preventDefault;
  var id = '/' + $("#id").val();
  var url = '/' + $("#url").val();
  var data = $(this).serialize();
  AjaxCalls(url, id, data, 'PUT');

  return false;
});




var abortAjax = '';

function AjaxWithToken(url, param = "", data = {}, method = "GET", callback = null) {
  var csrfToken = document.getElementsByTagName("meta")["csrf-token"].getAttribute("content");
  var send = url + param;
  if (abortAjax) abortAjax.abort();
  abortAjax = $.ajax({
    url: send,
    type: method,
    tryCount: 0,
    retryLimit: 3,
    data: {
      data: data,
      _token: csrfToken
    },
    async: true,
    error: function(data){
         var errors = data.responseJSON;
         console.log(errors);
         // Render the errors with js ...
       },
    success: function(data) {
      var alert = '<div class="alert-dismissible alert  ' + data.type + '"  >' + data.msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      $('.alertas').html(alert);
      if (callback != null) {
        callback();
      }
    }
  });
}


function AjaxCalls(url, param = "", data = {}, method = "GET", callback = null) {


  var send = url + param;

  if (abortAjax) abortAjax.abort();
    abortAjax = $.ajax({
    url: send,
    type: method,
    tryCount: 0,
    retryLimit: 3,
    data: data,
    async: true,
    beforeSend: function() {
      //$('#contentCenter').html(loading('table',0));
      // $("#loading-table").show();
    },
    error: function(data){
         var errors = data.responseJSON;
         console.log(errors);
         // Render the errors with js ...
       },

    complete: function() {

    },
    success: function(data) {
      if (data == '{"slug":["The slug has already been taken."]}') {

      }
      console.log(data);
      var alert = '<div class="alert-dismissible alert  ' + data.type + '"  >' + data.msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      $('.alertas').html(alert);

      if (callback != null) {
        callback();
      }
    }
  });
}
