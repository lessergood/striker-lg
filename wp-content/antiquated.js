var atqcolor = '#0094FF'; // atq background color code

// Only do something if jQuery isn't defined
if (typeof jQuery == 'undefined') {
  function getScript(url, success) {
    var script = document.createElement('script');
    script.src = url;
    var head = document.getElementsByTagName('head')[0],
    done = false;
    // Attach handlers for all browsers
    script.onload = script.onreadystatechange = function() {
      if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
      done = true;
        // callback function provided as param
        success();
        script.onload = script.onreadystatechange = null;
        head.removeChild(script);
      };
    };
    head.appendChild(script);
  };
  getScript('http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', function() {
    if (typeof jQuery=='undefined') {
      // Super failsafe - still somehow failed...
    } else {
      // jQuery loaded! Make sure to use .noConflict just in case
      $.noConflict();
      jQuery( document ).ready(function( $ ) {
        atq($);
      });
    }
  });
} else { // jQuery was already loaded
  // Run your jQuery Code
  $.noConflict();
  jQuery( document ).ready(function( $ ) {
    atq($);
  });
};
function rgb2hex(rgb){
  var old_color = rgb;
  rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
  return (rgb && rgb.length === 4) ? "#" 
    + ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) + ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) + ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : old_color;
}

var hexToRgb = function(hex) {
        var bigint = parseInt(hex, 16);
        var r = (bigint >> 16) & 255;
        var g = (bigint >> 8) & 255;
        var b = bigint & 255;
    
        return r + "," + g + "," + b;
    }
function atq($){
    $(document).on('mouseover',function(e){
      // ctrl or metakey (command on mac)
      if(e.ctrlKey===true || e.metaKey===true){
        e.preventDefault();
        e.stopPropagation();

        /* Cleanup any previous inspectors/highlights, we don't want another Smith in the Matrix incident now do we? */
        $('.atq_highlight').removeClass('atq_highlight');
        $('#atq').remove();

        /* TARGET Acquired Captain. */
        var target = e.target || e.srcElement;
        var elt = $(target)[0];
        console.log($(target));
        var atq_props = {};
        atq_props.tag = elt.tagName ? elt.tagName : '';
        atq_props.id = elt.id ? '#'+elt.id : '';
        atq_props.class = elt.className ? '.'+elt.className : '';
        atq_props.class = atq_props.class.replace('atq_highlight','') ;
        atq_props.name = elt.name ? elt.name : '';
        atq_props.parent = elt.parentNode[0] ? elt.parentNode[0] : '';
        atq_props.parent_id = $(atq_props.parent).attr('id') ? '#'+$(atq_props.parent).attr('id') : '';
        atq_props.parent_class = $(atq_props.parent).attr('class') ? '.'+$(atq_props.parent).attr('class') : '';
        atq_props.width = elt.offsetWidth;
        atq_props.height = elt.offsetHeight;
        atq_props.bgcolor = $(elt).css('background-color') ? $(elt).css('background-color').toUpperCase() : 'none';
        atq_props.color = $(elt).css('color').toUpperCase() ? $(elt).css('color').toUpperCase() : '';
        atq_props.margin = $(elt).css('margin');
        atq_props.margin_top =$(elt).css('margin-top');
        atq_props.margin_bottom = $(elt).css('margin-bottom');
        atq_props.margin_left = $(elt).css('margin-left');
        atq_props.margin_right = $(elt).css('margin-right');
        atq_props.padding = $(elt).css('padding');
        atq_props.padding_top = $(elt).css('padding-top');
        atq_props.padding_bottom = $(elt).css('padding-bottom');
        atq_props.padding_left = $(elt).css('padding-left');
        atq_props.padding_right = $(elt).css('padding-right');
        atq_props.border_width = $(elt).css('border-width') ? $(elt).css('border-width')  : '';
        atq_props.border_style = $(elt).css('border-style') ? $(elt).css('border-style') : '';
        atq_props.border_color = $(elt).css('border-color') ? $(elt).css('border-color') : '';
        atq_props.line_height = $(elt).css('line-height') ? $(elt).css('line-height') : '';
        atq_props.letter_spacing = $(elt).css('letter-spacing') ? $(elt).css('letter-spacing') : '';
        atq_props.x = $(elt).offset().top ?  $(elt).offset().top : '';
        atq_props.y = $(elt).offset().left ? $(elt).offset().left : '';
        atq_props.bottom = atq_props.x+atq_props.height+15;

        /* Now we actually build the inspector display */
        // build styles
        var atq_styles = '';
        atq_styles += '<style type="text/css" class="atq_styles">';
          atq_styles += '.atq_highlight{background: rgba('+hexToRgb(atqcolor.substring(1))+',0.2); -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)"; filter: alpha(opacity=20);}';
          /* tables */
          atq_styles += "div#atq table,#atq tbody,#atq tr,#atq td{font-size: 12px !important; padding: 0px !important; line-height: 18px !important; vertical-align: top !important; border-top: 0px !important; border: 0px}";
          /* container */
          atq_styles += "div#atq{font-family: sans-serif !important; font-size: 14px; padding: 10px; background: "+atqcolor+"; text-align: left; color: #FFF; border-radius: 5px; position: fixed; z-index: 999; width: 300px; top: "+atq_props.bottom+"px; left: "+atq_props.y+"px}";
          /* title */
          atq_styles += 'div#atq .atq_title{margin-top: 0px; padding: 0px; color: #FFF; margin-top: 0px; margin-bottom: 10px; font-size: 16px}';
          /* close */
          atq_styles += 'div#atq .atq-close{margin: 0px; padding: 0px; float: right; cursor: pointer; font-weight: bold}';
          atq_styles += 'div#atq span.atq_label{display: inline-block; width: 120px}';
          /* callout */
          atq_styles += "div.atq.triangle-border:before { content:''; position:absolute; bottom:-20px; left:40px; border-width: 20px 20px 0; border-style:solid; border-color: "+atqcolor+" transparent; display: block; width:0}";
          atq_styles += "div.atq.triangle-border:after { content:''; position:absolute; bottom:-13px; left:47px; border-width:13px 13px 0; border-style:solid; border-color:"+atqcolor+" transparent; display:block; width:0}";
          atq_styles += "div.atq.triangle-border.top:before {top:-20px; bottom:auto; left:auto; right:260px; border-width:0 20px 20px}";
          atq_styles += "div#atq.triangle-border.top:after {top:-13px; bottom:auto; left:auto; right:267px; border-width:0 13px 13px}";
          atq_styles += "div#atq.triangle-border.top-right:before {top:-20px; bottom:auto; left:auto; right:40px; border-width:0 20px 20px}";
          atq_styles += "div#atq.triangle-border.top-right:after {top:-13px; bottom:auto; left:auto; right:47px; border-width:0 13px 13px}";
        atq_styles += "</style>";
        $('.atq_styles').remove();
        $('head').append(atq_styles);
        
        // build js
        var atq_js = '<script>';
        atq_js += 'function removeAtq(){'
           atq_js += 'jQuery(\'.atq_highlight\').removeClass(\'atq_highlight\');'; 
          //atq_js += ' document.getElementById("atq").className = document.getElementById("atq").className.replace(/\batq_highlight\b/,\'\');';
          atq_js += ' document.getElementById("atq").remove();';
        atq_js += '}';
        atq_js += '</script>';
        $('head').append(atq_js);
        
        // add highlight to element
        $(target).addClass('atq_highlight');
        
        // build html
        var atq = '';
        atq += '<div class="atq-close" onclick="removeAtq()">X</div>';
        atq += '<div class="atq_title"><em>Antiquated Inspector</em></div>';
        atq += '';
        atq += '<div><span class="atq_label">parent:</span> <b>'+atq_props.parent_id+'</b></div>';
        atq += '<div><span class="atq_label">id/class:</span> <b>'+atq_props.id+' '+atq_props.class+'</b>';
        atq += '<div><span class="atq_label">tag/name:</span> <b>&lt;'+atq_props.tag.toLowerCase()+'&gt; '+atq_props.name+'</b></div>';

          /* margin */
          atq += '<div><span class="atq_label">margin:</span> <b>'+parseInt(atq_props.margin)+'</b></div>';
          /* padding */
          atq += '<div><span class="atq_label">padding:</span> <b>'+parseInt(atq_props.padding)+'</b></div>';
          /* border */
          atq += '<div><span class="atq_label">border:</span> <b>'+atq_props.border_width+' '+atq_props.border_style+' <span style="background: '+rgb2hex(atq_props.border_color)+' !important; width: 22px;">&nbsp;&nbsp;&nbsp;</span>&nbsp;'+rgb2hex(atq_props.border_color)+'</b></div>';
          /* line height */
          atq += '<div><span class="atq_label">line-height:</span> <b>'+parseInt(atq_props.line_height,10)+'px</b></div>';
          /* letter spacing */
          atq += '<div><span class="atq_label">letter-spacing:</span> <b>'+parseInt(atq_props.letter_spacing,10)+'px</b></div>';
        atq += '<div><span class="atq_label">width:</span> <b>'+atq_props.width+'px</b></div>';
        atq += '<div><span class="atq_label">height:</span> <b>'+atq_props.height+'px</b></div>';
        atq += '<div><span class="atq_label">x:</span> <b>'+parseInt(atq_props.x)+'px</b></div>';
        atq += '<div><span class="atq_label">y:</span> <b>'+parseInt(atq_props.y)+'px</b></div>';
        // divider
        atq += '<div style="width: 100%; border-bottom: 1px solid #ccc; margin-top: -10px; margin-bottom: 10px;">&nbsp;</div>';
            /* color */
            atq += '<div><span class="atq_label">color:</span> <span style="background: '+rgb2hex(atq_props.color)+' !important; width: 22px;">&nbsp;&nbsp;&nbsp;</span>&nbsp;<b>'+rgb2hex(atq_props.color).toUpperCase()+'</b></div>';
            /* background color */
            atq += '<div><span class="atq_label">bg&nbsp;color: </span>';
            atq += '<span style="background-color: '+rgb2hex(atq_props.bgcolor)+' !important; margin-top: 2px; width: 22px;">&nbsp;&nbsp;&nbsp;</span>&nbsp;<b>'+rgb2hex(atq_props.bgcolor).toUpperCase()+'</b></div>';
          atq += '<a style="color: #FFF; font-weight: bold; width: 300px; text-align: right;" href="http://antiquated.in" target="_blank"><em>antiquated.in</em></a></div>';
        /* Add the inspector to the target */
        $(target).parent().prepend('<div id="atq" class="atq triangle-border top">'+atq+'</div>');

        var winh = $(window).height();
        var winw = $(window).width();
        var half_winh = winh/2;
        var half_winw = winw/2;

        // if the target is huge, we just point to the top and stay on the interior for visibility
        if(atq_props.height > half_winh){
          $('#atq').css('top',atq_props.x+40);
          $('#atq').css('left','45%');
        }

        // flip to top of element, if below half way, so we can still see it for lower elements
        var atqh = $('#atq').height();
        if(atq_props.x > half_winh){
          $('#atq').removeClass('top');
          $('#atq').css('top',atq_props.x-atqh-40);
          $('#atq').css('margin-left',50);
        }
        var atqw = $('#atq').width();
        // flip to other side if too far to the right
        if(atq_props.y > half_winw){
          console.log(atq_props.y+' ? '+half_winw);
          $('#atq').css('left',atq_props.y-atqw);

        }

      }
    });

  $('*').keyup(function(e) {
    if (e.keyCode == 27) {
      removeAtq();
    }   // esc key pressed
  });

  $('#atq').blur(function(e) {
    removeAtq();
  });
};