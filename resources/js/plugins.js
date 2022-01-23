/**
 * Place any jQuery/helper plugins in here.
 */
$(function () {
  /**
   * Checkbox tree for permission selecting
   */
  let permissionTree = $('.permission-tree :checkbox');

  permissionTree.on('click change', function () {
    if ($(this).is(':checked')) {
      $(this).siblings('ul').find('input[type="checkbox"]').attr('checked', true).attr('disabled', true);
    } else {
      $(this).siblings('ul').find('input[type="checkbox"]').removeAttr('checked').removeAttr('disabled');
    }
  });

  permissionTree.each(function () {
    if ($(this).is(':checked')) {
      $(this).siblings('ul').find('input[type="checkbox"]').attr('checked', true).attr('disabled', true);
    }
  });

  /**
   * Disable submit inputs in the given form
   *
   * @param form
   */
  function disableSubmitButtons(form) {
    form.find('input[type="submit"]').attr('disabled', true);
    form.find('button[type="submit"]').attr('disabled', true);
  }

  /**
   * Enable the submit inputs in a given form
   *
   * @param form
   */
  function enableSubmitButtons(form) {
    form.find('input[type="submit"]').removeAttr('disabled');
    form.find('button[type="submit"]').removeAttr('disabled');
  }

  /**
   * Disable all submit buttons once clicked
   */
  $('form').submit(function () {
    disableSubmitButtons($(this));
    return true;
  });

  /**
   * Add a confirmation to a delete button/form
   */
  $('body').on('submit', 'form[name=delete-item]', function (e) {
    e.preventDefault();

    Swal.fire({
      title: '您確定要刪除此項目嗎？',
      showCancelButton: true,
      confirmButtonText: '確認刪除',
      cancelButtonText: '取消',
      icon: 'warning'
    }).then((result) => {
      if (result.value) {
        this.submit()
      } else {
        enableSubmitButtons($(this));
      }
    });
  })
    .on('submit', 'form[name=confirm-item]', function (e) {
      e.preventDefault();

      Swal.fire({
        title: '您確定您要這麼做嗎？',
        showCancelButton: true,
        confirmButtonText: '繼續',
        cancelButtonText: '取消',
        icon: 'warning'
      }).then((result) => {
        if (result.value) {
          this.submit()
        } else {
          enableSubmitButtons($(this));
        }
      });
    })
    .on('click', 'a[name=confirm-item]', function (e) {
      /**
       * Add an 'are you sure' pop-up to any button/link
       */
      e.preventDefault();

      Swal.fire({
        title: '您確定您要這麼做嗎？',
        showCancelButton: true,
        confirmButtonText: '繼續',
        cancelButtonText: '取消',
        icon: 'info',
      }).then((result) => {
        result.value && window.location.assign($(this).attr('href'));
      });
    });

  // Remember tab on page load
  $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
    let hash = $(e.target).attr('href');
    history.pushState ? history.pushState(null, null, hash) : location.hash = hash;
  });

  let hash = window.location.hash;
  if (hash) {
    $('.nav-link[href="' + hash + '"]').tab('show');
  }

  // Enable tooltips everywhere
  $('[data-toggle="tooltip"]').tooltip();
});

/**
 * Place gallery-slideshow plugins in here.
 */
const newElement = (tag, {
  styleCallback,
  src = '',
  className = '',
}) => {
  const element = document.createElement(tag);
  element.src = src;
  className = className;

  styleCallback(element.style, element)
  return element;
};

document.body.addEventListener('click', function (e) {
  /** @type {HTMLImageElement} */
  const originImg = e.target;
  if (originImg.tagName != 'IMG') {
    return;
  }

  if (originImg.classList.contains('previewImg')) {
    return;
  }

  const url = originImg.getAttribute('src');
  if (!url) {
    return;
  }

  if (!originImg.classList.contains('gallery-slideshow')) {
    return;
  }

  const blackBG = newElement('div', {
    styleCallback: (style, e) => {
      e.classList.add('fade-in-image');
      style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
      style.zIndex = 100000;
      style.top = '0';
      style.left = '0';
      style.height = '100vh';
      style.width = '100vw';
      style.position = 'fixed';
    },
  });

  const img = newElement('img', {
    src: url,
    className: 'previewImg',
    styleCallback: (style) => {
      // style.height = '95%';
      style.position = 'fixed';
      style.objectFit = 'cover';
      style.top = '50%';
      style.left = '50%';
      style.transform = 'translate(-50%, -50%)';
    },
  });

  blackBG.append(img);

  blackBG.onclick = () => {
    blackBG.remove();
  };

  document.body.appendChild(blackBG);
})
