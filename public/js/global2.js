//<!-- ////////////ESTO ES EL INPUT SEARCH /////////  -->
$(document).ready(function() {
  new UISearch(document.getElementById('sb-search'));
  new UISearch(document.getElementById('sb-search2'));
});
//<!-- ////////////FIN SEARCH /////////  -->

var WinLoseChart = {};
var weekBalance = [];
var weekBalancePPH = [];


$(document).ready(function() {

  callContent();


});


$(document).on("click", '.agent-name', function(e) {

  $("#tree-agent").collapse('toggle');

});

$(document).on("click", '.arrow', function() {

  var target = $(this).data("target");
  $(target).collapse('toggle');

});

$(document).on("click", ".agent", function(e) {
  Menu = [];
  e.stopPropagation();
  e.preventDefault();
  e.stopImmediatePropagation();


  if (window.innerWidth < 770) {
    $("#wrapper").toggleClass("toggled");
    $("#tree-agent").collapse('toggle');
    sidebarBotonesResponsive();
  }


  var IdAgent = $(this).data("target");

  $.ajax({
    url: "home/" + IdAgent,
    type: 'GET',
    tryCount: 0,
    retryLimit: 3,
    data: {},
    async: true,
    beforeSend: function() {
      $("div#divLoading").addClass('show');
      //$('.container-fluid').html("<h1>loading...</h1>");
      //$('#contentCenter').html(loading('table',0));
      // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
          console.log(textStatus + ' ' + errorThrown);
          $("div#divLoading").removeClass('show');
          $.ajax(this);
          return;
        }
      }
      return;
    },

    complete: function() {



    },
    success: function(data) {

      //$('#contentCenter').html(data);
      $("#sidebar-wrapper").html(data);
      callContent();

      //$('.agent-name').collapse();
    }
  });
});


function callContent() {

  $.ajax({
    url: "content",
    type: 'GET',
    tryCount: 0,
    retryLimit: 3,
    data: {},
    async: true,
    beforeSend: function() {
      //$('.container-fluid').html("<h1>loading...</h1>");
      //$('#contentCenter').html(loading('table',0));
      // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
          console.log(textStatus + ' ' + errorThrown);
          $("div#divLoading").removeClass('show');
          $.ajax(this);
          return;
        }
      }
      return;
    },

    complete: function() {

    },
    success: function(data) {

      $(".container-fluid").html(data);

      var winlosePromise = loadWinLoseWeekDataChart();
      var balancePromise = loadBalanceChart();
      var NavbarLogoMObilePromise = loadNavbarLogoMObile();
      var LoadPPHBalanceChartPromise = LoadPPHBalanceChart();

      Promise.all([winlosePromise, balancePromise, NavbarLogoMObilePromise, LoadPPHBalanceChartPromise]).then(function(value) {

        sparklineLogin();
        $("div#divLoading").removeClass('show');

      }, function(err) {
        console.log(err);
        $("div#divLoading").removeClass('show');
      });

    }
  });
}


function loadBalanceChart() {
  var promise = new Promise(function(resolve, reject) {
    $.ajax({
      url: "WeeksBalanceChart",
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            reject([false]);
          }
        }
        reject([false]);
      },
      success: function(data) {
        for (var i = 0; i < 6; i++) {
          var index = i + 1;
          weekBalance[i] = Math.round(parseFloat(data["balanceWeek" + index]));
        }
        resolve([weekBalance.reverse()]);
      }
    });
  });
  return promise;
}

function loadNavbarLogoMObile() {
  var promise = new Promise(function(resolve, reject) {
    $.ajax({
      url: "navbarHeaderLogo",
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            reject([false]);
          }
        }
        reject([false]);
      },
      success: function(data) {
        $(".navbar-header.logo").html(data);
        resolve([data]);
      }
    });
  });
  return promise;
}

function loadWinLoseWeekDataChart() {
  var promise = new Promise(function(resolve, reject) {
    $.ajax({
      url: "WinLoseWeekChart",
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            reject([false]);
            //return;
          }
        }
        reject([false]);
        //return;
      },
      success: function(data) {
        WinLoseChart.ThisWeekValue = createGraphic(data.chart[0]);
        WinLoseChart.LastWeekValue = createGraphic(data.chart[1]);
        resolve(WinLoseChart);

      }

    });
  });
  return promise;
}

function LoadPPHBalanceChart() {
  var promise = new Promise(function(resolve, reject) {
    $.ajax({
      url: "PPHBalanceChart",
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            reject([false]);
            //return;
          }
        }
        reject([false]);
        //return;
      },
      success: function(data) {
        weekBalancePPH = data;
        resolve(data);

      }

    });
  });
  return promise;
}


function createGraphic(arrayData) {
  var cant = 0;
  var WinChartValue = [];
  arrayData.forEach(function(item, index) {
    cant += parseFloat(item);
    WinChartValue[index] = cant;
  });
  return WinChartValue;
}

// <!-- //////////// CONFIGURACION MINI-CHARTS /////////  -->
var sparklineLogin = function() {
  $('.inlinesparkline').sparkline(weekBalance, {
    type: 'line',
    width: '100%',
    height: '40',
    tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{y:val}})',
    tooltipValueLookups: {
      names: {
        0: 'Semana 1',
        1: 'Semana 2',
        2: 'Semana 3',
        3: 'Semana 4',
        4: 'Semana 5',
        5: 'Semana 6'
          // Add more here
      }
    }
  });

  $('.inlinesparklinePPH').sparkline(weekBalancePPH, {
    type: 'line',
    width: '100%',
    height: '40',
    tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{y:val}})',
    tooltipValueLookups: {
      names: {
        0: 'Semana 1',
        1: 'Semana 2',
        2: 'Semana 3',
        3: 'Semana 4',
        4: 'Semana 5',
        5: 'Semana 6'
          // Add more here
      }
    }
  });
  var composite = $('.compositeline');

  var minThisWeek = Math.min.apply(null, WinLoseChart.ThisWeekValue);
  var maxThisWeek = Math.max.apply(null, WinLoseChart.ThisWeekValue);
  var minLastWeek = Math.min.apply(null, WinLoseChart.LastWeekValue);
  var maxLastWeek = Math.max.apply(null, WinLoseChart.LastWeekValue);

  var min = (minThisWeek > minLastWeek) ? minLastWeek : minThisWeek;
  var max = (maxThisWeek < maxLastWeek) ? maxLastWeek : maxThisWeek;

  composite.sparkline(WinLoseChart.ThisWeekValue, {
    fillColor: false,
    chartRangeMin: min,
    chartRangeMax: max,
    width: '100%',
    height: '60'
  });
  composite.sparkline(WinLoseChart.LastWeekValue, {
    composite: true,
    fillColor: false,
    lineColor: 'red',
    chartRangeMin: min,
    chartRangeMax: max,

  });

  $('.bar').sparkline([1, 4, 4, -7, -5, 9, 10], {
    type: 'bar',
    width: '100%',
    barWidth: '7',
    height: '40',
    barColor: '#34A853',
    tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{value:val}})',
    tooltipValueLookups: {
      names: {
        0: 'Lunes',
        1: 'Martes',
        2: 'Miercoles',
        3: 'Jueves',
        4: 'Viernes',
        5: 'Sabado',
        6: 'Domingo'
          // Add more here
      }
    }
  });
  $(".tristate").sparkline([8, 4, 5, 4, 2, 8, 5], {
    type: 'tristate'
  });
}
var sparkResize;
$(window).resize(function() {
  clearTimeout(sparkResize);
  sparkResize = setTimeout(sparklineLogin, 500);
});

$(document).on('change', '#selectPickerPlayerPayment', function(e) {
  var url = $('.modal-body').data('url');
  var param = '/' + $(this).val();
  loadModalData(url, param);
});

$(document).on('submit', '#AddPayment', function(e) {
  e.preventDefault;
  var data = $(this).serialize();
  UpdateData('AddPlayerTransaction', data, '', 'POST');
  return false;
});



// <!-- //////////// FIN CONFIGURACION MINI-CHARTS /////////  -->
$(document).on('submit', '#PlayerFlagMessage', function(e) {
  e.preventDefault;
  var IdPlayer = $('#selectPickerPlayerFlag').val();
  var data = $(this).serialize();
  console.log(IdPlayer);
  UpdateData('FlagMessage', data, '/' + IdPlayer, 'PUT');
  return false;
});

$(document).on('submit', '#PlayerMassiveMessage', function(e) {
  e.preventDefault;
  var data = $(this).serialize();
  UpdateData('MassiveMessage', data, '', 'POST');
  return false;
});



$(document).on('submit', '#MoveAgent', function(e) {

  e.preventDefault;
  var data = $(this).serialize();
  var IdAgent = $('#selectPickerAgent').val();

  UpdateData('MoveAgent', data, '/' + IdAgent, 'PUT');

  return false;
});

$(document).on('change', '#selectPickerPlayerFlag', function(e) {
  e.preventDefault;
  var IdPlayer = $('#selectPickerPlayerFlag').val();
  var promise = loadData('GetPlayerData/', IdPlayer);
  promise.then(function(playerData) {

    if (typeof playerData[0] != "undefined") {

      $('#message').val(playerData[0].OnlineMessage);
      $("#messageGroup").css('display', 'block');

    }

  }).catch(function(err) {
    console.log(err);
  });

});


$(document).on('change', '#selectPickerAgent', function(e) {

  e.preventDefault;
  var IdAgent = $(this).val();
  var Masters = $('#selectpickerToShowHide');

  if (IdAgent != "" && (typeof IdAgent != "undefined")) {

    var promise = loadData('GetAgentData/', IdAgent);
    promise.then(function(data) {
      if (data.length > 0) {
        var agentData = data[0];
        $('#prmOldIdDistributor').val(agentData.Distributor);

        var selected = $("#selectpickerToShowHide").find("option[value='" + agentData.Distributor + "']");
        console.log(selected);
        selected.attr('selected', 'selected');
        $('.selectpicker').selectpicker('refresh');


      }
      Masters.css('display', 'block');

    }).catch(function(err) {
      console.log(err);
    });


  } else {
    Masters.css('display', 'none');
  }
  return false;
})


$(document).on('submit', '#AddAgent', function(e) {
  e.preventDefault();
  var data = $(this).serialize();
  // var IdPlayerStr = data.split("&")[0];
  // var IdPlayer = '/' + IdPlayerStr.split("IdPlayer=")[1];

  UpdateData('AddAgent', data, '', 'POST');
  return false;

});


$(document).on('click', '.MSbtn', function(e) {
  e.preventDefault;

  var url = $(this).attr('data-url');
  console.log(url);
  loadModalData(url);

  return false;
});


$(document).on('click', '.PositionDetails', function(e) {

  var startDate = $(this).attr("data-startdate"); //get page number from link
  var endDate = $(this).attr("data-enddate"); //get page number from link
  var IdGame = $(this).attr("data-idgame"); //get page number from link

  var param = '/' + startDate + '/' + endDate + '/' + IdGame;

  loadModalData('AgentPositionDetails', param);
});

$(document).on("click", "nav .pagination a, .back", function(e) {
  e.preventDefault();
  var page = $(this).attr("data-page"); //get page number from link
  var url = $(this).attr("data-url"); //get url to call
  var str = $(this).attr("data-type");
  if (typeof str != 'undefined') {
    var pieces = str.split("@");
    console.log(pieces);
    if (pieces.length > 1) {
      var param = "";
      pieces.forEach(function(elem, index) {
        param += "/" + elem;
      });
    } else {
      var param = '/' + $(this).attr("data-type"); //get params to that url
    }
  }


  page = (typeof page == 'undefined') ? '' : page;
  param = (typeof param == 'undefined') ? '' : param;
  loadModalData(url, param, page);

});


$(document).on("click", ".ExposureDetail", function(e) {

  var IdGame = $(this).attr("data-game");
  var WagerType = $(this).attr("data-wt");
  var Play = $(this).attr("data-play");
  var totalRisk = $(this).attr("data-resultrisk");
  var totalWin = $(this).attr("data-resultwin");

  var url = "AgentExposureDetails";
  var param = "/" + IdGame + "/" + WagerType + "/" + Play + "/" + totalRisk + "/" + totalWin;
  loadModalData(url, param);
});

$(document).on('submit', '#PostPlayer', function(e) {

  e.preventDefault();
  var data = $(this).serialize();
  UpdateData('PlayersAdd', data, '', 'POST');
  return false;

});

$(document).on('submit', '#EditPlayer', function(e) {
  e.preventDefault();
  var data = $(this).serialize();
  var IdPlayerStr = data.split("&")[0];
  var IdPlayer = '/' + IdPlayerStr.split("IdPlayer=")[1];

  UpdateData('updatePlayer', data, IdPlayer);
  return false;

});

$(document).on('submit', '#EditProfileLimit', function(e) {
  e.preventDefault();
  var data = $(this).serialize();
  UpdateData('updateProfileLimit', data);
  return false;

});

$(document).on('change', '#selectPickerPlayer', function() {

  var url = $('.modal-body').data('url');
  var param = '/' + $(this).val();
  loadModalData(url, param);

});

$(document).on('change', '#selectPickerSport', function() {

  var url = $('.modal-body').data('url');
  var param = '/' + $(this).val();
  loadModalData(url, param);

});

$(document).on('change', '#selectPickerProfile', function() {

  var url = $('.modal-body').data('url');
  var param = '/' + $(this).val();
  loadModalData(url, param);

});

$(document).on('change', '#selectPickerProfileLimit', function() {
  if ($('#selectPickerGameType').val()) {
    $('#selectPickerGameType').change();
  }
});


$(document).on('change', '#selectPickerGameType', function() {

  $('#GameTypeSelected')
    .empty()
    .append('<option value="-1" selected>EDIT ALL GAME TYPE SELECTED</option>');

  var textSelected;
  if ($(this).val())
    for (var i = 0; i < $(this).val().length; i++) {
      textSelected = $("#selectPickerGameType option[value='" + $(this).val()[i] + "']").text();
      $('#GameTypeSelected')
        .append('<option value="' + $(this).val()[i] + '" data-index="' + i + '" data-content="EDIT - ' + textSelected + ' <button data-value=\'' + $(this).val()[i] + '\' class=\'btn btn-xs btn-warning pull-right delete-option\' type=\'button\' name=\'button\' style=\'position: absolute; right: 20px;\'><i class=\'glyphicon glyphicon-remove\' ></i></button>" ></option>');
    }
  $('#GameTypeSelected').selectpicker('refresh');
  if ($('#selectPickerProfileLimit').val()) {
    if ($(this).val())
      if ($(this).val().length == 1) {
        $('#GameTypeSelected').find("[value='" + $(this).val()[0] + "']").prop('selected', true);
        $('#GameTypeSelected').selectpicker('refresh');
      }
    $('#GameTypeSelected').change();

  }

});

$(document).on('change', '#selectPickerOpt', function() {

  $('#selectPickerGameType').change();

});

$(document).on('change', '.select-sport-xs', function() {


  $(".select-" + $(this).val() + " option[value='" + $(this).val() + "']").prop('selected', true);
  $('.select-sport-xs').selectpicker('refresh');
  var idsport_pl = $(this).data('sport');
  $('.show-' + idsport_pl).addClass('hidden-xs');
  $('.show-' + $(this).val()).removeClass('hidden-xs');


});

$(document).on("click", ".delete-option", function(e) {

  var index = $(this).attr("data-value");
  $('.remove-select').find('[value=' + index + ']').remove();
  $('.remove-select').find("[value='-1']").prop('selected', true);
  $('.remove-select').selectpicker('refresh');
  $("#selectPickerGameType option[value='" + index + "']").prop('selected', false);
  $('#selectPickerGameType').selectpicker('refresh');
  if ($('#selectPickerGameType').val())
    if ($('#selectPickerGameType').val().length == 1) {
      $('#GameTypeSelected').find("[value='" + $('#selectPickerGameType').val()[0] + "']").prop('selected', true);
      $('#GameTypeSelected').selectpicker('refresh');
    }
  $('#GameTypeSelected').change();

});

$(document).on('change', '#GameTypeSelected', function() {


  if ($('#selectPickerProfileLimit').val()) {
    var GameTypes = 0;
    if ($('#selectPickerGameType').val()) GameTypes = $(this).val();

    var url = $('.modal-body').data('url');
    var param = '/' + $('#selectPickerProfileLimit').val() + '/' + GameTypes + '/' + $('#selectPickerOpt').val() + '/' + 'true';
    loadModalData(url, param, 1, '.table-edit');
  }

});

$(document).on('click', '#rest_profileLimit', function() {

  $('#GameTypeSelected').change();

});


$(document).on('submit', '#PlayerHistorySearch', function(e) {
  console.log("submit");
  e.preventDefault();
  var inputs = $('#PlayerHistorySearch :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = "/" + values["startDate"] + "/" + values["endDate"] + "/" + values["idplayer"];
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});



$(document).on('submit', '#formPlayerAccess', function(e) {
  console.log("submit");
  e.preventDefault();
  var inputs = $('#formPlayerAccess :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = "/" + values["startDate"] + "/" + values["endDate"] + "/" + values["idplayer"] + "/" + values["ip"];
    console.log(param);
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});

$(document).on('submit', '#searchTop', function(e) {
  e.preventDefault();
  var inputs = $('#searchTop :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = "/" + values["startDate"] + "/" + values["endDate"] + "/" + values["sport"] + "/" + values["order"] + "/" + values["NumPlayers"];
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});

$(document).on('submit', '#adjustmentSearch', function(e) {
  e.preventDefault();
  var inputs = $('#adjustmentSearch :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = "/" + values["startDate"] + "/" + values["endDate"];
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});


$(document).on('submit', '#agentHistorySearch', function(e) {
  console.log("submit");
  e.preventDefault();
  var inputs = $('#agentHistorySearch :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = "/" + values["startDate"] + "/" + values["endDate"] + "/" + values["transaction"];
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});



$(document).on('submit', '#DistributionSearch', function(e) {
  e.preventDefault();
  var inputs = $('#DistributionSearch :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var param = '/' + values['week'];
    loadModalData(values['url'], param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});



$(document).on('submit', '#standingSearch', function(e) {
  e.preventDefault();
  var inputs = $('#standingSearch :input');
  var promise = getVars(inputs);
  promise.then(function(values) {

    var url = values['url']
    var param = '/' + values['startDate'];
    console.log(url + param);
    loadModalData(url, param);

  }).catch(function(err) {
    console.log(err);
  });
  return false;
});


$(document).on('submit', '#positionSearch', function(e) {
  e.preventDefault();
  var inputs = $('#positionSearch :input');
  var promise = getVars(inputs);

  promise.then(function(values) {

    var url = values['url']
    var param = '/' + values['startDate'] + '/' + values['endDate'] + '/' + values['isTNT'] + '/1';

    loadModalData(url, param);

  }).catch(function(err) {
    console.log(err);
  });

  return false;
});


//load reports in modal
$(document).on('hidden.bs.modal', '#myModal', function(e) {


  console.log("launch");

  if ($(this).hasClass("all-agent-color")) {

    $(this).removeClass("all-agent-color");

  } else if ($(this).hasClass("all-player-color")) {

    $(this).removeClass("all-player-color");

  } else if ($(this).hasClass("all-wagers-color")) {

    $(this).removeClass("all-wagers-color");

  } else if ($(this).hasClass("all-financial-color")) {

    $(this).removeClass("all-financial-color");

  } else if ($(this).hasClass("all-premium-color")) {

    $(this).removeClass("all-premium-color");
  }
})

$(document).on("click", ".viewreport", function(e) {

  $("#myModal .modal-title").html($(this).data('title'));

  var ColorClass = (typeof $(this).data('color') != "undefined") ? $(this).data('color') : 'all-agent-color';
  $("#myModal").addClass(ColorClass);

  if ($(this).data('url')) {

    var url = $(this).data('url');

    var param = "";
    if ($(this).data('url') == 'AgentExposure') param = "/NFL";
    loadModalData(url, param);

  } else {
    $("#myModal .modal-body").html('NO URL');
  }
});

function UpdateData(url, data, param = '', type = 'PUT') {
  var send = url + param;
  $.ajax({
    url: send,
    type: type,
    tryCount: 0,
    retryLimit: 3,
    data: data,
    async: true,
    beforeSend: function() {
      // $('#myModal .modal-body').html("<h1>loading...</h1>");
      // //$('#contentCenter').html(loading('table',0));
      // // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
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
      var alert = '<div class="alert-dismissible alert  ' + data.type + '"  >' + data.msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
      $('.alertas').html(alert);
      // $("html, body").animate({
      //   scrollTop: 0
      // }, "slow");
    }
  });
}


function loadData(url, param = "") {
  var promise = new Promise(function(resolve, reject) {
    var send = url + param;
    $.ajax({
      url: send,
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            return;
          }
        }
        reject(textStatus + ' ' + errorThrown);

      },
      success: function(data) {
        resolve(data);
      }
    });
  });
  return promise;
}



var abortAjax = '';

function loadModalData(url, param = "", page = 1, otherClass = '') {

  var send = url + param;
  if (page != 1) {
    send = url + param + "/" + page;
  }
  if (abortAjax) abortAjax.abort();
  abortAjax = $.ajax({
    url: send,
    type: 'GET',
    tryCount: 0,
    retryLimit: 3,
    data: {},
    async: true,
    beforeSend: function() {
      $('#myModal .modal-body ' + otherClass).html("<h1>loading...</h1>");
      //$('#contentCenter').html(loading('table',0));
      // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
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
      $("#myModal .modal-body " + otherClass).html(data);
      $('.modal-body ' + otherClass).data('url', url)
      $('#myTabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
      })

      $('.selectpicker').selectpicker();
      $('.datepicker_').datepicker().on('changeDate', function(ev) {
        $(this).datepicker('hide');
      });
      $('[data-toggle="tooltip"]').tooltip();

      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });

    }
  });
}





var Menu = [];
$(document).on('click', '.fav-choise, .del-choise', function() {
  var url = $(this).data("url");
  var title = $(this).data("title");

  if (typeof $(this).find(".fav-icon")[0] != "undefined") {

    $(this).find(".fav-icon").toggleClass("glyphicon-star-empty").toggleClass("glyphicon-star");

  } else {

    var elemento = $(".scroll-fav").find("[data-title='" + title + "']");
    elemento.find(".fav-icon").toggleClass("glyphicon-star-empty").toggleClass("glyphicon-star");

  }




  if (Menu.length < 1) {

    // console.log("load");
    var promise = loadMenu();
    promise.then(function(data) {

      Menu = JSON.parse(data);

      loadNewMenu(title, Menu)

    }).catch(function(err) {
      console.log(err);
    });
  } else {
    loadNewMenu(title, Menu)
  }
});


function loadMenu() {
  var promise = new Promise(function(resolve, reject) {
    $.ajax({
      url: "getMenu",
      type: 'GET',
      tryCount: 0,
      retryLimit: 3,
      data: {},
      async: true,
      beforeSend: function() {
        // $('#myModal .modal-body').html("<h1>loading...</h1>");
        // //$('#contentCenter').html(loading('table',0));
        // // $("#loading-table").show();
      },
      error: function(xhr, textStatus, errorThrown) {
        this.tryCount++;
        if (textStatus != 'abort') {
          if (this.tryCount <= this.retryLimit) {
            console.log(textStatus + ' ' + errorThrown);
            $.ajax(this);
            reject(textStatus + ' ' + errorThrown);
          }
        }
        reject(textStatus + ' ' + errorThrown);
      },

      complete: function() {

      },
      success: function(data) {
        resolve(data);
      }
    });
  });
  return promise;
}

var pass = 0;

function SeekOnMenu(title, array) {
  var promise = new Promise(function(resolve, reject) {
    array.find(function(element, index, _array) {
      element.menu.find(function(elemento, indice, _arreglo) {
        if (elemento.title == title) {
          if (elemento == array[index].menu[indice]) {
            // console.log(elemento);
            array[index].menu[indice].panel = Boolean(array[index].menu[indice].panel);
            array[index].menu[indice].panel = Boolean(!array[index].menu[indice].panel);

            resolve(array);
          }

        }
      });

    });
    reject("no element");
  });
  return promise;
}


function loadNewMenu(title, Menu) {
  var promise = SeekOnMenu(title, Menu);

  promise.then(function(data) {
    Menu = data;
    UpdateMenu(Menu);

  }).catch(function(err) {
    console.log(err);
  });
}


function UpdateMenu(Menu) {
  csrfToken = document.getElementsByTagName("meta")["csrf-token"].getAttribute("content");
  var formData = new FormData();

  $.ajax({
    url: "updateMenu",
    type: 'POST',
    tryCount: 0,
    retryLimit: 3,
    data: {
      menu: Menu,
      _token: csrfToken
    },
    async: true,
    beforeSend: function() {
      // $('#myModal .modal-body').html("<h1>loading...</h1>");
      // //$('#contentCenter').html(loading('table',0));
      // // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
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
      // console.log(data);
      callContent();
    }
  });
}


function getVars(inputs) {

  var promise = new Promise(function(resolve, reject) {
    var values = {};
    inputs.each(function() {
      values[this.name] = $(this).val();
    });
    resolve(values);
  });
  return promise;

}

$(document).on('keypress', '.number', function(event) {
  if (event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 9)
    return true;
  else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
    event.preventDefault();
});



function UpdateMenu(Menu) {
  csrfToken = document.getElementsByTagName("meta")["csrf-token"].getAttribute("content");
  var formData = new FormData();

  $.ajax({
    url: "updateMenu",
    type: 'POST',
    tryCount: 0,
    retryLimit: 3,
    data: {
      menu: Menu,
      _token: csrfToken
    },
    async: true,
    beforeSend: function() {
      // $('#myModal .modal-body').html("<h1>loading...</h1>");
      // //$('#contentCenter').html(loading('table',0));
      // // $("#loading-table").show();
    },
    error: function(xhr, textStatus, errorThrown) {
      this.tryCount++;
      if (textStatus != 'abort') {
        if (this.tryCount <= this.retryLimit) {
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
      // console.log(data);
      callContent();
    }
  });
}


function getVars(inputs) {

  var promise = new Promise(function(resolve, reject) {
    var values = {};
    inputs.each(function() {
      values[this.name] = $(this).val();
    });
    resolve(values);
  });
  return promise;

}

$(document).on('keypress', '.number', function(event) {
  if (event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 9)
    return true;
  else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
    event.preventDefault();
});
