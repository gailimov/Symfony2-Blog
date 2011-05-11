/**
 * Main JavaScript functions file
 * 
 * @author    Kanat Gailimov, http://gailimov.info
 * @copyright Kanat Gailimov, 2011
 */


/**
 * Replies in the comments
 *
 * @param {string} name To answer?
 */
function reply(name) {
    var ccomment = document.getElementById('ccomment');
    if (ccomment.value == 'Комментарий *') {
        ccomment.value = name + ', ';
    } else {
        ccomment.value += name + ', ';
    }
    ccomment.focus();
}

/** BB-code editor */
function insertBBCode(taObj, bbTag, promptText) {
    if (!taObj) return false;
    var caretPos = 0;
    var start = 0;
    var end = 0;
    var selText;
    var openBB = "";
    if (promptText) {
        var usText = prompt(promptText, '');
            if (usText) openBB = "["+bbTag+"="+usText+"]";
            else openBB = "["+bbTag+"]";
    } else {
        openBB = "["+bbTag+"]";
    }
    var closeBB = "[/"+bbTag+"]";
    taObj.focus();
    if (document.getSelection || window.getSelection) {
        start = taObj.selectionStart;
        end = taObj.selectionEnd;
    } else if (document.selection) {
        var sel = document.selection.createRange();
        var clone = sel.duplicate();
        sel.collapse(true);
        clone.moveToElementText(taObj);
        clone.setEndPoint("EndToEnd", sel);
        start = clone.text.length;
        sel = document.selection.createRange();
        clone = sel.duplicate();
        sel.collapse(false);
        clone.moveToElementText(taObj);
        clone.setEndPoint("EndToEnd", sel);
        end = clone.text.length;
    }
    if (start === end) {
        var str = taObj.value;
        taObj.value = str.substring(0, start)+openBB+closeBB+str.substr(start);
        var nPos = start+openBB.length;
        if (taObj.createTextRange) {
            var caret = taObj.createTextRange();
            caret.collapse();
            caret.moveStart("character", nPos);
            caret.select();
        } else if(window.getSelection) {
            taObj.setSelectionRange(nPos, nPos);
            taObj.focus();
        }
    } else if (start < end) {
        var str = taObj.value;
        selText = str.substring(start, end);
        taObj.value = str.substring(0, start)+openBB+selText+closeBB+str.substr(end);
    }
}
var textarea = null;
window.onload = function() {
    textarea = document.getElementById('ccomment'); // Textarea's ID
}


/**
 * Here begins the code using jQuery
 */
$(function() {

    /** Placeholder */
    if (!Modernizr.input.placeholder) {
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();
        $('[placeholder]').parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            })
        });
    }

    /** Go to top button */
    speed = 500;
    e = $(".scrollTop");
    e.click(function() {
        $("html:not(:animated)" +(!$.browser.opera ? ",body:not(:animated)" : "")).animate({scrollTop: 0}, 500);
        return false;
    });
    // Showing
    function show_scrollTop() {
        ($(window).scrollTop() > 300) ? e.fadeIn(600) : e.hide();
    }
    $(window).scroll(function() {
        show_scrollTop()
    });
    show_scrollTop();
    
    // show passwords
    $('#show-password').click(function() {
        password = $('#password').val();
        $('#password').replaceWith('<input type="text" name="password" id="password" value="' + password + '" required />');
        return false;
    });

});
