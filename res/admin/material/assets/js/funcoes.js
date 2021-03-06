
$(document).ready(function() {
  $().ready(function() {
    $sidebar = $('.sidebar');

    $sidebar_img_container = $sidebar.find('.sidebar-background');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    window_width = $(window).width();

    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
      if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
        $('.fixed-plugin .dropdown').addClass('open');
      }

    }

    $('.fixed-plugin a').click(function(event) {
      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
      if ($(this).hasClass('switch-trigger')) {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
      }
    });

    $('.fixed-plugin .active-color span').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-color', new_color);
      }

      if ($full_page.length != 0) {
        $full_page.attr('filter-color', new_color);
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.attr('data-color', new_color);
      }
    });

    $('.fixed-plugin .background-color .badge').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('background-color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-background-color', new_color);
      }
    });

    $('.fixed-plugin .img-holder').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).parent('li').siblings().removeClass('active');
      $(this).parent('li').addClass('active');


      var new_image = $(this).find("img").attr('src');

      if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        $sidebar_img_container.fadeOut('fast', function() {
          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $sidebar_img_container.fadeIn('fast');
        });
      }

      if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $full_page_background.fadeOut('fast', function() {
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          $full_page_background.fadeIn('fast');
        });
      }

      if ($('.switch-sidebar-image input:checked').length == 0) {
        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
      }
    });

    $('.switch-sidebar-image input').change(function() {
      $full_page_background = $('.full-page-background');

      $input = $(this);

      if ($input.is(':checked')) {
        if ($sidebar_img_container.length != 0) {
          $sidebar_img_container.fadeIn('fast');
          $sidebar.attr('data-image', '#');
        }

        if ($full_page_background.length != 0) {
          $full_page_background.fadeIn('fast');
          $full_page.attr('data-image', '#');
        }

        background_image = true;
      } else {
        if ($sidebar_img_container.length != 0) {
          $sidebar.removeAttr('data-image');
          $sidebar_img_container.fadeOut('fast');
        }

        if ($full_page_background.length != 0) {
          $full_page.removeAttr('data-image', '#');
          $full_page_background.fadeOut('fast');
        }

        background_image = false;
      }
    });

    
    $('.switch-sidebar-mini input').change(function() {
      $body = $('body');

      $input = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

      } else {

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

        setTimeout(function() {
          $('body').addClass('sidebar-mini');

          md.misc.sidebar_mini_active = true;
        }, 300);
      }


      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);

    });
  });
});

    // input mask for CEP
    $(document).ready(function () { 
        var $campoCEP = $(".maskCEP");
        $campoCEP.mask("99999-999");
    });

    // input mask for phone
    $(document).ready(function () { 
        var $campoPhone = $(".maskPhone");
        $campoPhone.mask("(999)9999-9999");
    });

    // input mask for cellphone
    $(document).ready(function () { 
        var $campoCellPhone = $(".maskCellPhone");
        $campoCellPhone.mask("(999)99999-9999");
    });

    // input mask for CPF
    $(document).ready(function () { 
        var $campoCPF = $(".maskCPF");
        $campoCPF.mask("999.999.999-99");
    });

    // input mask for RG
    $(document).ready(function () { 
        var $campoRG = $(".maskRG");
        $campoRG.mask("99.999.999-9");
    });

    // input mask for RG
    $(document).ready(function () { 
        var $campoCNPJ = $(".maskCNPJ");
        $campoCNPJ.mask("99.999.999/9999-99");
    });

    // input mask for RG
    $(document).ready(function () { 
        var $campoCNPJ = $(".calendario");
        $campoCNPJ.mask("99/99/9999");
    });
    
    // input mask for Data
    $(document).ready(function () { 
        var $campoData = $(".maskData");
        $campoData.mask("99/99/9999");
    });

    // input mask for UF
    $(document).ready(function () { 
        var $campoUf = $(".maskUf");
        $campoUf.mask("AA");
    });

    // input mask for Data
    $(document).ready(function () { 
        $('.maskMoney').maskMoney({
            prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, allowZero:true});
    })

    // input mask for Number thousand
    $(document).ready(function () { 
        $('.inputNumber').maskMoney({
          showSymbol: false,
          precision: 0,
          allowNegative: false,
          thousands:'.',
          affixesStay: false});
    })

        // input mask for Number thousand
        $(document).ready(function () { 
          $('.inputNumberDec').maskMoney({
            showSymbol: false,
            precision: 2,
            allowNegative: false,
            thousands:'.',
            decimal:',',
            affixesStay: false});
      })

    // input mask for Number thousand
    $(document).ready(function () { 
        $('.maskPeso').maskMoney({
          showSymbol: false,
          precision: 3,
          allowNegative: false,
          thousands:'.',
          decimal:',',
          affixesStay: false});
    })

    // input mask for Number thousand
    $(document).ready(function () { 
        $('.maskPercent').maskMoney({
          showSymbol: false,
          precision: 4,
          allowNegative: false,
          thousands:'.',
          decimal:',',
          affixesStay: false});
    });

    // input mask for Data
    $(document).ready(function () { 
        var $campoPlaca = $(".maskPlacaCar");
        $campoPlaca.mask("SSS 9999");
    });

    $(document).ready(function(){
      $(".caixa_alta").keyup(function(){
      $(this).val($(this).val().toUpperCase());

    });

    $(document).ready(function () { 
        var $campoUf = $(".maskYearModel");
        $campoUf.mask("9999/9999");
    });

});

$('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});

function calcular(){

// atribui o valor do campo na variável
var varValUnit = document.getElementById("VALOR").value;

// remove ponto de milhar
varValUnit = varValUnit.split(".").join("");

// substitui a virgula por ponto
varValUnit = varValUnit.split(",").join(".");

// atribui o valor do campo na variável
var varQtde = document.getElementById("QTD").value;

// remove ponto de milhar
varQtde = varQtde.split(".").join("");

// substitui a virgula por ponto
varQtde = varQtde.split(",").join(".");

// formata a soma dos números para exibiçã no campo
//var soma = accounting.formatNumber(varValUnit * varQtde, 2, ".", ",");
var soma = (varValUnit * varQtde);
// manda o valor para o campo
document.getElementById("SUBTOTAL").value=soma.toLocaleString('pt-BR',{ style: 'currency', currency:'BRL'});

};