//##################################################################################

//## FORM SUBMIT WITH AJAX                                                        ##

//## @Author: Simone Rodriguez aka Pukos <http://www.SimoneRodriguez.com>         ##

//## @Version: 1.2                                                                ##

//## @Released: 28/08/2007                                                        ##

//## @License: GNU/GPL v. 2 <http://www.gnu.org/copyleft/gpl.html>                ##

//##################################################################################





function xmlhttpPost(strURL,formname,responsediv,responsemsg) {

    var xmlHttpReq = false;

    var self = this;

    // Xhr per Mozilla/Safari/Ie7

    if (window.XMLHttpRequest) {

        self.xmlHttpReq = new XMLHttpRequest();

    }

    // per tutte le altre versioni di IE

    else if (window.ActiveXObject) {

        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

    self.xmlHttpReq.open('POST', strURL, true);

    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    self.xmlHttpReq.onreadystatechange = function() {

        if (self.xmlHttpReq.readyState == 4) {

			// Quando pronta, visualizzo la risposta del form

            updatepage(self.xmlHttpReq.responseText,responsediv);
				$('form').fadeOut('fast', function() {
				document.getElementById(responsediv).innerHTML = "Thanks for your expertise! <a href='" + responsemsg + "'>See your fix</a>.";
				$('#success').fadeIn('fast');
				});
        }

		else{

			// In attesa della risposta del form visualizzo il msg di attesa

			updatepage(responsemsg,responsediv);



		}

    }

    self.xmlHttpReq.send(getquerystring(formname));

}



function getquerystring(formname) {

    var form = document.forms[formname];

	var qstr = "";



    function GetElemValue(name, value) {

        qstr += (qstr.length > 0 ? "&" : "")

            + escape(name).replace(/\+/g, "%2B") + "="

            + escape(value ? value : "").replace(/\+/g, "%2B");

			//+ escape(value ? value : "").replace(/\n/g, "%0D");

    }

	

	var elemArray = form.elements;

    for (var i = 0; i < elemArray.length; i++) {

        var element = elemArray[i];

        var elemType = element.type.toUpperCase();

        var elemName = element.name;

        if (elemName) {

            if (elemType == "TEXT"

                    || elemType == "TEXTAREA"

                    || elemType == "PASSWORD"

					|| elemType == "BUTTON"

					|| elemType == "RESET"

					|| elemType == "SUBMIT"

					|| elemType == "FILE"

					|| elemType == "IMAGE"

                    || elemType == "HIDDEN")

                GetElemValue(elemName, element.value);

            else if (elemType == "CHECKBOX" && element.checked)

                GetElemValue(elemName, 

                    element.value ? element.value : "On");

            else if (elemType == "RADIO" && element.checked)

                GetElemValue(elemName, element.value);

            else if (elemType.indexOf("SELECT") != -1)

                for (var j = 0; j < element.options.length; j++) {

                    var option = element.options[j];

                    if (option.selected)

                        GetElemValue(elemName,

                            option.value ? option.value : option.text);

                }

        }

    }

    return qstr;

}

function updatepage(str,responsediv){

    document.getElementById(responsediv).innerHTML = str;

}


		(function($){
			// jQuery autoGrowInput plugin by James Padolsey
			// See related thread: http://stackoverflow.com/questions/931207/is-there-a-jquery-autogrow-plugin-for-text-fields
						  
			$.fn.autoGrowInput = function(o) {
								
				o = $.extend({
					maxWidth: 1000,
					minWidth: 0,
					comfortZone: 10
				}, o);
								
				this.filter('input:text').each(function(){
								 
					var minWidth = o.minWidth || $(this).width(),
					val = '',
					input = $(this),
					testSubject = $('<tester/>').css({
					position: 'absolute',
					top: -9999,
					left: -9999,
					width: 'auto',
					fontSize: input.css('fontSize'),
					fontFamily: input.css('fontFamily'),
												fontWeight: input.css('fontWeight'),
												letterSpacing: input.css('letterSpacing'),
												whiteSpace: 'nowrap'
										  }),
										  check = function() {
												
												if (val === (val = input.val())) {return;}
												
												// Enter new content into testSubject
												var escaped = val.replace(/&/g, '&amp;').replace(/\s/g,'&nbsp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
												testSubject.html(escaped);
												
												// Calculate new width + whether to change
												var testerWidth = testSubject.width(),
													 newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
													 currentWidth = input.width(),
													 isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth)
																				 || (newWidth > minWidth && newWidth < o.maxWidth);
												
												// Animate width
												if (isValidWidthChange) {
													 input.width(newWidth);
												}
												
										  };
										  
									 testSubject.insertAfter(input);
									 
									 $(this).bind('keyup keydown blur update', check);
									 
								});
								
								return this;
						  
						  };
						  
					 })(jQuery);
    
					if (Modernizr.mq('only screen and (min-width: 480px)')) {  
						$('input').autoGrowInput();
					}
				
