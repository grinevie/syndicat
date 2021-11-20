$("a.scroll-to").click(function() {
    $("html, body").animate({
       scrollTop: $($(this).attr("href")).offset().top + "px"
    }, {
       duration: 500,
       easing: "swing"
    });
    return false;
});

//Form Sheet

const id = 'AKfycbz-uAIvKFuT-SWsJJi4TXh0FIj9QF-VfzqFA_B5USY33JvjSDGA';
const URL = `https://script.google.com/macros/s/${id}/exec`;
const form = document.querySelector("#test-form");
const redirectUrl = 'success-page.html';

form.onsubmit = (e) => {
	e.preventDefault();
	const formData = new FormData(form);
    const interestsarr = formData.getAll("Interests[]");
    const interestsstr = interestsarr.join(', ');
    formData.set("Interests", interestsstr);
	const json = JSON.stringify({...Object.fromEntries(formData), promocode: $("input#promocode").val()});

	fetch(URL, {
		method: "post",
		headers: {
			"Content-Type": "text/plain;charset=utf-8",
		},
		body: json
	})
		.then((res) => res.json())
		.then(() => location.href='/success-page.html')
		.catch(err => document.body.append(err.message));
};

//Custom select checkbox


function checkboxDropdown(el) {
    var $el = $(el)
  
    function updateStatus(label, result) {
      if(!result.length) {
        label.find('.dropdown-label');
      }
    };
    
    $el.each(function(i, element) {
      var $list = $(this).find('.dropdown-list'),
        $label = $(this).find('.dropdown-label'),
        $checkAll = $(this).find('.check-all'),
        $inputs = $(this).find('.check'),
        defaultChecked = $(this).find('input[type=checkbox]:checked'),
        result = [];
      
      updateStatus($label, result);
      if(defaultChecked.length) {
        defaultChecked.each(function () {
          result.push($(this).next().text());
          $label.html(result.join(", "));
        });
      }
      
      $label.on('click', ()=> {
        $(this).toggleClass('open');
      });
  
      $checkAll.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        result = [];
        if(checked) {
          result.push(checkedText);
          $label.html(result);
          $inputs.prop('checked', false);
        }else{
          $label.html(result);
        }
          updateStatus($label, result);
      });
  
      $inputs.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        if($checkAll.is(':checked')) {
          result = [];
        }
        if(checked) {
          result.push(checkedText);
          $label.html(result.join(", "));
          $checkAll.prop('checked', false);
        }else{
          let index = result.indexOf(checkedText);
          if (index >= 0) {
            result.splice(index, 1);
          }
          $label.html(result.join(", "));
        }
        updateStatus($label, result);
      });
  
      $(document).on('click touchstart', e => {
        if(!$(e.target).closest($(this)).length) {
          $(this).removeClass('open');
        }
      });
    });
  };
  
  checkboxDropdown('.dropdown'); 