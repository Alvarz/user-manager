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
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
          if (errorThrown == 'Unprocessable Entity') {
            console.log(errorThrown);
            var alert = '<div class="alert-dismissible alert  alert-danger"  >An error has occurred <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            $('.alertas').html(alert);
          }
          console.log(textStatus + ' ' + errorThrown);
          $.ajax(this);
          return;
        }
      }
      return;
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
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
          if (errorThrown == 'Unprocessable Entity') {
            var alert = '<div class="alert-dismissible alert alert-danger"  >An error has occurred <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            $('.alertas').html(alert);
          }
          console.log(textStatus + ' ' + errorThrown);
          $.ajax(this);
          return;
        }
      }
      return;
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
