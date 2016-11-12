$(document).on('change', '#states', function(e) {
  e.preventDefault;
  var idProperty = $(this).data('id');
  var State = $('#states').val();
  var url = '/' + $(this).data('url');
  var param = '/' + idProperty + '/' + State;
  console.log(url);
  AjaxWithToken(url, param, '', 'PUT', function() {
    // setTimeout(function() {
    //   location.reload();
    // }, 3000);
  });
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
