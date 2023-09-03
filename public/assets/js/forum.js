// Isi dari file 1 (forum.js)
var myVar = setInterval(LoadData, 2000);

http_request = new XMLHttpRequest();

function LoadData() {
  $.ajax({
    url: 'view.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      $('#MyTable tbody').empty();
      for (var i = 0; i < data.length; i++) {
        var commentId = data[i].id;
        if (data[i].parent_comment == 0) {
          var row = $(
            '<tr><td><b><img src="avatar.jpg" width="30px" height="30px" />' +
              data[i].student +
              ' :<i> ' +
              data[i].date +
              ':</i></b></br><p style="padding-left:80px">' +
              data[i].post +
              '</br><a data-toggle="modal" data-id="' +
              commentId +
              '" title="Add this item" class="open-ReplyModal" href="#ReplyModal">Reply</a>' +
              '</p></td></tr>'
          );
          $('#record').append(row);
          for (var r = 0; r < data.length; r++) {
            if (data[r].parent_comment == commentId) {
              var comments = $(
                '<tr><td style="padding-left:80px"><b><img src="avatar.jpg" width="30px" height="30px" />' +
                  data[r].student +
                  ' :<i> ' +
                  data[r].date +
                  ':</i></b></br><p style="padding-left:40px">' +
                  data[r].post +
                  '</p></td></tr>'
              );
              $('#record').append(comments);
            }
          }
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('Error: ' + textStatus + ' - ' + errorThrown);
    },
  });
}

$(document).on('click', '.open-ReplyModal', function () {
  var commentid = $(this).data('id');
  $('.modal-body #commentid').val(commentid);
});

//Post data to the server
$(document).ready(function () {
  $('#butsave').on('click', function () {
    $('#butsave').attr('disabled', 'disabled');
    var id = document.forms['frm']['Pcommentid'].value;
    var name = document.forms['frm']['name'].value;
    var msg = document.forms['frm']['msg'].value;
    if (name != '' && msg != '') {
      $.ajax({
        url: 'save.php',
        type: 'POST',
        data: {
          id: id,
          name: name,
          msg: msg,
        },
        cache: false,
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            $('#butsave').removeAttr('disabled');
            document.forms['frm']['Pcommentid'].value = '';
            document.forms['frm']['name'].value = '';
            document.forms['frm']['msg'].value = '';
            LoadData();
          } else if (dataResult.statusCode == 201) {
            alert('Error occured !');
          }
        },
      });
    } else {
      alert('Please fill all the field !');
    }
  });
});

//Reply comment
$(document).ready(function () {
  $('#btnreply').on('click', function () {
    $('#btnreply').attr('disabled', 'disabled');
    var id = document.forms['frm1']['Rcommentid'].value;
    var name = document.forms['frm1']['Rname'].value;
    var msg = document.forms['frm1']['Rmsg'].value;
    if (name != '' && msg != '') {
      $.ajax({
        url: 'save.php',
        type: 'POST',
        data: {
          id: id,
          name: name,
          msg: msg,
        },
        cache: false,
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            $('#btnreply').removeAttr('disabled');
            document.forms['frm1']['Rcommentid'].value = '';
            document.forms['frm1']['Rname'].value = '';
            document.forms['frm1']['Rmsg'].value = '';
            LoadData();
            $('#ReplyModal').modal('hide');
          } else if (dataResult.statusCode == 201) {
            alert('Error occured !');
          }
        },
      });
    } else {
      alert('Please fill all the field !');
    }
  });
});

// Isi dari file 2 (main.js)
(function () {
  // ======= Sticky
  window.onscroll = function () {
    const ud_header = document.querySelector('.ud-header');
    const sticky = ud_header.offsetTop;
    const logo = document.querySelector('.header-logo');

    if (window.pageYOffset > sticky) {
      ud_header.classList.add('sticky');
    } else {
      ud_header.classList.remove('sticky');
    }

    // === logo change
    if (ud_header.classList.contains('sticky')) {
      logo.src = 'assets/images/logo/logo.svg';
    } else {
      logo.src = 'assets/images/logo/logo-white.svg';
    }

    // show or hide the back-to-top button
    const backToTop = document.querySelector('.back-to-top');
    if (
      document.body.scrollTop > 50 ||
      document.documentElement.scrollTop > 50
    ) {
      backToTop.style.display = 'flex';
    } else {
      backToTop.style.display = 'none';
    }
  };

  // ===== responsive navbar
  let navbarToggler = document.querySelector('#navbarToggler');
  const navbarCollapse = document.querySelector('#navbarCollapse');

  navbarToggler.addEventListener('click', () => {
    navbarToggler.classList.toggle('navbarTogglerActive');
    navbarCollapse.classList.toggle('hidden');
  });

  //===== close navbar-collapse when a  clicked
  document
    .querySelectorAll('#navbarCollapse ul li:not(.submenu-item) a')
    .forEach((e) =>
      e.addEventListener('click', () => {
        navbarToggler.classList.remove('navbarTogglerActive');
        navbarCollapse.classList.add('hidden');
      })
    );

  // ===== Sub-menu
  const submenuItems = document.querySelectorAll('.submenu-item');
  submenuItems.forEach((el) => {
    el.querySelector('a').addEventListener('click', () => {
      el.querySelector('.submenu').classList.toggle('hidden');
    });
  });

  // ===== Faq accordion
  const faqs = document.querySelectorAll('.single-faq');
  faqs.forEach((el) => {
    el.querySelector('.faq-btn').addEventListener('click', () => {
      el.querySelector('.icon').classList.toggle('rotate-180');
      el.querySelector('.faq-content').classList.toggle('hidden');
    });
  });

  // ===== wow js
  new WOW().init();

  // ====== scroll top js
  function scrollTo(element, to = 0, duration = 500) {
    const start = element.scrollTop;
    const change = to - start;
    const increment = 20;
    let currentTime = 0;

    const animateScroll = () => {
      currentTime += increment;

      const val = Math.easeInOutQuad(currentTime, start, change, duration);

      element.scrollTop = val;

      if (currentTime < duration) {
        setTimeout(animateScroll, increment);
      }
    };

    animateScroll();
  }

  Math.easeInOutQuad = function (t, b, c, d) {
    t /= d / 2;
    if (t < 1) return (c / 2) * t * t + b;
    t--;
    return (-c / 2) * (t * (t - 2) - 1) + b;
  };

  document.querySelector('.back-to-top').onclick = () => {
    scrollTo(document.documentElement);
  };
})();
